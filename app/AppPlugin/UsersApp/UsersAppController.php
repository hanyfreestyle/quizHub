<?php

namespace App\AppPlugin\UsersApp;

use App\AppPlugin\UsersApp\Traits\UsersAppConfigTraits;
use App\Http\Controllers\PortalMainController;
use Illuminate\Support\Facades\Auth;


class UsersAppController extends PortalMainController {
    use UsersAppConfigTraits;


    public function __construct() {
        parent::__construct();
        $this->middleware('auth:customer');


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function dashBoard() {
        self::LoadUserProfile();
        $page['title'] = __('portal/dash.app_menu');
        return view('portal.dash-board')->with([
            'page' => $page,
        ]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function logOut() {
        Auth::guard('customer')->logout();
        return redirect()->route('web.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function helpers() {
        self::LoadUserProfile();
        $page['title'] = __('portal/cards.app_menu_list');
        $userId = $this->authUser->id;
        $cards = PortalCard::query()->where('user_id', $userId)->get();
        return view('portal.cards.helper')->with([
            'page' => $page,
            'cards' => $cards,
        ]);
    }
}
