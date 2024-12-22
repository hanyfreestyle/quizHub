<?php

namespace App\AppPlugin\UsersApp;

use App\AppPlugin\PortalCard\Models\PortalCardFields;
use App\AppPlugin\PortalCard\Models\PortalCardInput;
use App\AppPlugin\PortalCard\Models\PortalCardInputTranslation;
use App\AppPlugin\UsersApp\Models\UsersApp;
use App\AppPlugin\UsersApp\Models\UsersAppAddress;
use App\AppPlugin\UsersApp\Models\UsersAppImage;
use App\AppPlugin\UsersApp\Models\UsersAppPhotos;
use App\AppPlugin\UsersApp\Request\UsersProfileAddressAddRequest;
use App\AppPlugin\UsersApp\Request\UsersProfileAddressEditRequest;
use App\AppPlugin\UsersApp\Request\UsersProfilePasswordUpdateRequest;
use App\AppPlugin\UsersApp\Request\UsersProfileUpdateRequest;
use App\AppPlugin\UsersApp\Traits\UsersAppConfigTraits;
use App\Http\Controllers\PortalMainController;
use App\Http\Traits\PortalFieldsTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;

class PortalProfileController extends PortalMainController {

    use UsersAppConfigTraits;

    public function __construct() {
        parent::__construct();
        $this->middleware('auth:customer');

        $this->config = self::LoadConfig();
        View::share('config', $this->config);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function editProfile() {
        self::LoadUserProfile();
        $page['title'] = __('portal/profile.app_menu_edit');


        return view('portal.profile.edit')->with([
            'page' => $page,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function updateProfile(UsersProfileUpdateRequest $request) {
        $UserProfile = Auth::guard('customer')->user();
        $updateUser = UsersApp::def()->where('id', $UserProfile->id)->firstOrFail();
        try {
            DB::transaction(function () use ($updateUser, $request) {
                $updateUser->name = $request->input('name');
                $updateUser->phone = $request->input('phone');
                $updateUser->phone_code = $request->input('countryCode_phone');
                $updateUser->whatsapp = $request->input('whatsapp');
                if ($request->input('whatsapp')) {
                    $updateUser->whatsapp_code = $request->input('countryCode_whatsapp');
                }
                $updateUser->save();
            });
        } catch (\Exception $exception) {
            return back()->with(['ExceptionNotSave' => '']);
        }
        return redirect()->route('portal.profile.editProfile')->with('UpdateDone', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function updatePassword() {
        self::LoadUserProfile();
        $page['title'] = __('portal/profile.app_menu_edit_pass');

        return view('portal.profile.updatePassword')->with([
            'page' => $page,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function saveNewPassword(UsersProfilePasswordUpdateRequest $request) {
        $failedAttempts = session('failed_attempts', 0);
        if ($failedAttempts >= 3) {
            Auth::guard('customer')->logout();
            session(['failed_attempts' => 0]);
            return redirect()->route('portal.login')->with('Error', 'تم تسجيل الخروج بسبب المحاولات الفاشلة المتكررة.');
        }
        $hashedPassword = Auth::guard('customer')->user()->password;

        if (Hash::check($request->input('old_password'), $hashedPassword)) {
            $UserProfile = Auth::guard('customer')->user();
            $customer = UsersApp::query()
                ->where('id', $UserProfile->id)
                ->where('status', 1)
                ->where('is_active', 1)
                ->firstOrFail();
            $customer->password = Hash::make($request->input('password'));
            $customer->password_temp = null;
            $customer->save();
            Auth::guard('customer')->logout();
            return redirect()->route('portal.login');
        } else {
            session(['failed_attempts' => $failedAttempts + 1]);
            return redirect()->back()->with('Error', __('web/profileMass.pass_not_match'));
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function updateProfilePhoto() {
        self::LoadUserProfile();
        $page['title'] = __('portal/cropper.profile_h1');
        $page['title_p'] = __('portal/cropper.profile_p');
        $page['aspectRatio'] = 1;
        $page['imageType'] = 'profile';
        $page['rang'] = '400|2000';

        return view('portal.profile.updatePhoto')->with([
            'page' => $page,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function updateProfileBanner() {
        self::LoadUserProfile();
        $page['title'] = __('portal/cropper.banner_h1');
        $page['title_p'] = __('portal/cropper.banner_p');
        $page['aspectRatio'] = 2;
        $page['imageType'] = 'banner';
        $page['rang'] = '600|3000';
        return view('portal.profile.updatePhoto')->with([
            'page' => $page,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function uploadImage(Request $request) {

        $user = Auth::guard('customer')->user();
        $image = $request->file('image');
        $imageType = $request->input('imageType');
        $originalImage = Image::make($image);


        if ($imageType == 'profile') {
            $sizes = [
                ['size' => 'xl', 'width' => 600, 'height' => 600],
                ['size' => 'l', 'width' => 450, 'height' => 450],
                ['size' => 'm', 'width' => 250, 'height' => 250],
                ['size' => 's', 'width' => 100, 'height' => 100],
            ];
        } elseif ($imageType == 'banner') {
            $sizes = [
                ['size' => 'xl', 'width' => 1200, 'height' => 680],
                ['size' => 'l', 'width' => 900, 'height' => 510],
                ['size' => 'm', 'width' => 600, 'height' => 340],
                ['size' => 's', 'width' => 300, 'height' => 170],
            ];
        } else {
            $sizes = [
                ['size' => 'm', 'width' => 600, 'height' => 340],
            ];
        }


        $paths = [];

        foreach ($sizes as $size) {
            $filename = 'profile_' . time() . '_' . $size['size'] . '.webp';
            $path = public_path('images/user-profile/' . $filename);
            $resizedImage = $originalImage->fit($size['width'], $size['height']);
            $resizedImage->encode('webp', 80);
            $resizedImage->save($path);
            $paths[] = [
                'user_id' => $user->id,
                'type' => $imageType,
                'size' => $size['size'],
                'path' => 'images/user-profile/' . $filename,
            ];
        }


        $oldImages = UsersAppPhotos::query()->where('user_id', $user->id)->where('type', $imageType)->get();
        foreach ($oldImages as $oldImage) {
            if (File::exists($oldImage->path)) {
                File::delete($oldImage->path);
            }
            $oldImage->delete();
        }

        foreach ($paths as $path) {
            $newSave = new UsersAppPhotos();
            $newSave->user_id = $user->id;
            $newSave->type = $imageType;
            $newSave->size = $path['size'];
            $newSave->path = $path['path'];
            $newSave->save();
        }


        return response()->json(['success' => true]);
    }





#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function try(Request $request) {
        try {
            DB::transaction(function () use ($user, $request) {


            });
        } catch (\Exception $exception) {
            return back()->with(['ExceptionNotSave' => '']);
        }
        return redirect()->route('UsersApp_ProfileAddress')->with('UpdateDone', "");
    }


}
