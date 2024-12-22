<?php

namespace App\AppPlugin\UsersApp;

use App\AppPlugin\UsersApp\Models\UsersApp;
use App\AppPlugin\UsersApp\Models\UsersAppAddress;
use App\AppPlugin\UsersApp\Request\UsersProfileAddressAddRequest;
use App\AppPlugin\UsersApp\Request\UsersProfileAddressEditRequest;
use App\AppPlugin\UsersApp\Request\UsersProfilePasswordUpdateRequest;
use App\AppPlugin\UsersApp\Request\UsersProfileUpdateRequest;
use App\AppPlugin\UsersApp\Traits\UsersAppConfigTraits;
use App\Http\Controllers\WebMainController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class UsersAppProfileController extends WebMainController {

    use UsersAppConfigTraits;

    public function __construct() {
        parent::__construct();

        $this->config = self::LoadConfig();
        View::share('config', $this->config);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ProfileView() {
        $meta = parent::getMeatByCatId('profile_page');
        parent::printSeoMeta($meta, 'web.index');
        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'profile_page';
        $pageView['page'] = 'login_page';
        $pageView['profileMenu'] = 'accountInfo';
        $UserProfile = Auth::guard('customer')->user();
        return view('AppPlugin.UsersApp.profile.index')->with([
            'pageView' => $pageView,
            'UserProfile' => $UserProfile,
            'meta' => $meta,
        ]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ProfileUpdate(UsersProfileUpdateRequest $request) {
        $UserProfile = Auth::guard('customer')->user();
        $customer = UsersApp::def()->where('id', $UserProfile->id)->firstOrFail();
        try {
            DB::transaction(function () use ($customer, $request) {
                $customer->name = $request->input('name');
                $customer->email = $request->input('email');
                $customer->whatsapp = $request->input('whatsapp');
                $customer->save();
            });
        } catch (\Exception $exception) {
            return back()->with(['ExceptionNotSave' => '']);
        }
        return redirect()->route('UsersApp_Profile')->with('UpdateDone', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ProfileChangePassword() {

        $meta = parent::getMeatByCatId('profile_page');
        parent::printSeoMeta($meta, 'web.index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'profile_page';
        $pageView['page'] = 'login_page';
        $pageView['profileMenu'] = 'ChangePassword';

        $oldPass = null;
        if (isset($_GET['old'])) {
            $oldPass = $_GET['old'];
        }
        return view('AppPlugin.UsersApp.profile.password_change')->with([
            'pageView' => $pageView,
            'meta' => $meta,
            'oldPass' => $oldPass,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ProfileChangePasswordUpdate(UsersProfilePasswordUpdateRequest $request) {

        $SinglePageView = $this->SinglePageView;
        $SinglePageView['profileMenu'] = "ChangePassword";
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
            return redirect()->route('UsersApp_login');
        } else {
            return redirect()->back()->with('Error', __('web/profileMass.pass_not_match'));
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ProfileAddressList() {

        $meta = parent::getMeatByCatId('profile_page');
        parent::printSeoMeta($meta, 'web.index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'profile_page';
        $pageView['page'] = 'login_page';
        $pageView['profileMenu'] = 'AddressInfo';

        $UserProfile = Auth::guard('customer')->user();

        $customer = UsersApp::def()
            ->where('id', $UserProfile->id)
            ->withCount('addresses')
            ->with('addresses')
            ->firstOrFail();

        return view('AppPlugin.UsersApp.profile.address_list')->with([
            'pageView' => $pageView,
            'UserProfile' => $UserProfile,
            'meta' => $meta,
            'customer' => $customer,
        ]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ProfileAddressAdd() {
        $meta = parent::getMeatByCatId('profile_page');
        parent::printSeoMeta($meta, 'web.index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'profile_page';
        $pageView['page'] = 'login_page';
        $pageView['profileMenu'] = 'AddressInfo';

        $UserProfile = Auth::guard('customer')->user();

        $customer = UsersApp::def()
            ->where('id', $UserProfile->id)
            ->withCount('addresses')
            ->with('addresses')
            ->firstOrFail();

        if ($customer->addresses_count < 4) {
            return view('AppPlugin.UsersApp.profile.address_form')->with([
                'pageView' => $pageView,
                'meta' => $meta,
                'UserProfile' => $UserProfile,
                'customer' => $customer,
            ]);
        } else {
            return view('AppPlugin.UsersApp.profile.address_list')->with([
                'pageView' => $pageView,
                'meta' => $meta,
                'UserProfile' => $UserProfile,
                'customer' => $customer,
            ]);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ProfileAddressSave(UsersProfileAddressAddRequest $request) {
        $UserProfile = Auth::guard('customer')->user();
        $user = UsersApp::def()
            ->where('id', $UserProfile->id)
            ->withCount('addresses')
            ->firstOrFail();

        if ($user->addresses_count < 4) {
            try {
                DB::transaction(function () use ($user, $request) {

                    $saveAddress = new UsersAppAddress();

                    if ($user->addresses_count == 0) {
                        $saveAddress->is_default = true;
                        $saveAddress->name = __('web/profile.address_text_def_adress');
                    } else {
                        $saveAddress->name = __('web/profile.address_text_def_adress_name') . " " . $user->addresses_count + 1;
                    }
                    $saveAddress->uuid = Str::uuid()->toString();
                    $saveAddress->user_id = $user->id;

                    $saveAddress->recipient_name = $request->input('recipient_name');
                    $saveAddress->phone = $request->input('phone');
                    $saveAddress->phone_code = $request->input('countryCode_phone');
                    $saveAddress->phone_option = $request->input('phone_option');
                    $saveAddress->phone_option_code = $request->input('countryCode_phone_option');
                    $saveAddress->address = $request->input('address');
                    $saveAddress->save();
                });
            } catch (\Exception $exception) {
                return back()->with(['ExceptionNotSave' => '']);
            }

            return redirect()->route('UsersApp_ProfileAddress')->with('UpdateDone', "");

        } else {
            return back()->with(['ExceptionNotSave' => 'ssssssssssssssssss']);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ProfileAddressEdit($uuid) {
        $isUuid = Str::isUuid($uuid);

        if (!$isUuid) {
            Auth::guard('customer')->logout();
            return redirect()->route('UsersApp_login');
        }

        $meta = parent::getMeatByCatId('profile_page');
        parent::printSeoMeta($meta, 'web.index');
        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'profile_page';
        $pageView['page'] = 'login_page';
        $pageView['profileMenu'] = 'AddressInfo';

        $UserProfile = Auth::guard('customer')->user();

        $address = UsersAppAddress::query()
            ->where('uuid', $uuid)
            ->where('user_id', $UserProfile->id)
            ->firstOrFail();

        return view('AppPlugin.UsersApp.profile.address_form_edit')->with([
            'pageView' => $pageView,
            'UserProfile' => $UserProfile,
            'address' => $address,
            'meta' => $meta,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ProfileAddressUpdate(UsersProfileAddressEditRequest $request, $uuid) {
        $isUuid = Str::isUuid($uuid);

        if (!$isUuid) {
            Auth::guard('customer')->logout();
            return redirect()->route('UsersApp_login');
        }

        $UserProfile = Auth::guard('customer')->user();
        $address = UsersAppAddress::query()
            ->where('uuid', $uuid)
            ->where('user_id', $UserProfile->id)
            ->firstOrFail();

        try {
            DB::transaction(function () use ($address, $request) {
                $address->name = $request->input('name');
                $address->recipient_name = $request->input('recipient_name');
                $address->phone = $request->input('phone');
                $address->phone_code = $request->input('countryCode_phone');
                if ($request->input('phone_option')) {
                    $address->phone_option = $request->input('phone_option');
                    $address->phone_option_code = $request->input('countryCode_phone_option');
                }
                $address->address = $request->input('address');
                $address->save();
            });
        } catch (\Exception $exception) {
            return redirect()->route('UsersApp_ProfileAddress')->with(['ExceptionNotSave' => '']);
        }
        return redirect()->route('UsersApp_ProfileAddress')->with('UpdateDone', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ProfileAddressUpdateDefault($uuid) {
        $UserProfile = Auth::guard('customer')->user();

        $all_Address = UsersAppAddress::query()
            ->where('user_id', $UserProfile->id)
            ->get();

        if (count($all_Address) > 0) {
            foreach ($all_Address as $address) {
                if ($address->uuid == $uuid) {
                    $address->is_default = true;
                } else {
                    $address->is_default = false;
                }
                $address->save();
            }
        }
        return redirect()->back();
    }

}
