<?php

namespace App\AppPlugin\UsersApp;

use App\AppPlugin\Config\Privacy\WebPrivacy;
use App\AppPlugin\UsersApp\Models\UsersApp;
use App\AppPlugin\UsersApp\Request\ForgetPasswordRequest;
use App\AppPlugin\UsersApp\Request\UsersAppRequest;
use App\AppPlugin\UsersApp\Request\UsersAppSignUpRequest;
use App\AppPlugin\UsersApp\Traits\UsersAppConfigTraits;
use App\Http\Controllers\PortalMainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class UsersAppGuestController extends PortalMainController {

    use UsersAppConfigTraits;

    public function __construct() {
        parent::__construct();
        $this->config = self::LoadConfig();
        View::share('config', $this->config);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function saveTheme(Request $request) {
        session(['theme' => $request->theme]);
        return response()->json(['success' => true]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function saveToggleSidebar(Request $request) {
        if ($request->current) {
            session(['ToggleSidebar' => ' close_icon']);
        } else {
            session(['ToggleSidebar' => null]);
        }
        return response()->json(['success' => true]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function logIn() {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('portal.dashboard');
        }
        return view('portal.auth.login')->with([

        ]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function logInCheck(UsersAppRequest $request) {
        $credentials = array_merge($request->only('email', "password"), ['is_active' => 1]);
        if (Auth::guard('customer')->attempt($credentials)) {
            $user = UsersApp::find(Auth::guard('customer')->user()->id);
            $user->last_login = now();
            $user->password_temp = null;
            $user->save();
            return redirect()->route('portal.dashboard');
        } else {
            return redirect()->route('portal.login')->with('Error', __('portal/auth.err_login'));
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function SignUp() {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('portal.dashboard');
        }

        $Terms = WebPrivacy::where('is_active', true)
            ->with('translation')
            ->orderBy('position', 'asc')
            ->get();



        return view('portal.auth.register')->with([
            'Terms' => $Terms,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function SignUpCreate(UsersAppSignUpRequest $request) {

        $user = new UsersApp();
        $user->uuid = Str::uuid()->toString();
        $user->is_active = true;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->password);
        $user->last_login = now();
        $user->save();

        try {
            $user->save();
            Auth::guard('customer')->login($user);

        } catch (\Exception $e) {
            $err = $e->getMessage();
            return redirect()->back()->with('err', "dddddd");
        }
        return redirect()->route('portal.dashboard');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function forgetPassword() {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('portal.dashboard');
        }
        return view('portal.auth.forgetPassword')->with([

        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function forgetPasswordSend(ForgetPasswordRequest $request) {

        $email = $request->input('email');
        $userUpdate = UsersApp::query()->where('email', $email)->firstOrFail();
        $RandomNumber = RandomNumber('6');
        $userUpdate->recovery_code = $RandomNumber;
        $userUpdate->recovery_count = intval($userUpdate->recovery_count) + 1;
//        dd($userUpdate);

        try {
            $userUpdate->save();


        } catch (\Exception $e) {
            $err = $e->getMessage();
            return redirect()->back()->with('err', "dddddd");
        }
//        return redirect()->route('portal.dashboard');
    }


}
