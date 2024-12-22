<?php

namespace App\Http\Controllers;

use App\AppPlugin\PortalCard\Models\PortalCardInput;
use App\Helpers\MinifyTools;
use App\Http\Traits\GetCashListWeb;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class PortalMainController extends DefaultMainController {
    use GetCashListWeb;

    public function __construct() {
        parent::__construct();

        $this->MinifyTools = new MinifyTools();
        $this->minType = "Seo";
        $this->reBuild = true;
        $this->cssMinifyType = "Seo"; # Web , WebMini , Seo
        $this->cssReBuild = true;
        View::share('cssReBuild', $this->cssReBuild);
        View::share('cssMinifyType', $this->cssMinifyType);

        View::share('MinifyTools', $this->MinifyTools);
        View::share('minType', $this->minType);
        View::share('reBuild', $this->reBuild);

        $this->PrefixRoute = "protal";
        View::share('PrefixRoute', $this->PrefixRoute);

        $this->page = array();
        View::share('page', $this->page);

        $this->DefCat = self::LoadCategory();
        View::share('DefCat', $this->DefCat);

        $this->DefPhotoList = self::getDefPhotoList(0);
        View::share('DefPhotoList', $this->DefPhotoList);

        $this->cashCardInputTemplate = self::CashCardInputTemplate();
        $this->CashCardInputVipTemplate = self::CashCardInputVipTemplate();
        View::share('cashCardInputTemplate', $this->cashCardInputTemplate);
        View::share('CashCardInputVipTemplate', $this->CashCardInputVipTemplate);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CashCardInputTemplate($stopCash = 0) {
        $stopCash = 1;
        if ($stopCash) {

            $CashCardInputTemplate = PortalCardInput::query()
                ->where('is_active', true)
                ->orderBy('cat_id')
                ->orderBy('position')
                ->get()
                ->groupBy('cat_id');


        } else {
//            $CashCardInputTemplate = Cache::remember('CashCardInputTemplate', cashDay(7), function () {
//                return PortalCardInput::query()->get()->sortBy('position')->groupBy('cat_id');
//            });
        }
        return $CashCardInputTemplate;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CashCardInputVipTemplate($stopCash = 0) {
        $stopCash = 1;
        if ($stopCash) {
            $CashCardInputVipTemplate = PortalCardInput::query()
                ->where('is_active', 1)->where('vip', true)->orderBy('position_vip')->get();
        } else {
//            $CashCardInputVipTemplate = Cache::remember('CashCardInputVipTemplate', cashDay(7), function () {
//                return PortalCardInput::query()->get()->sortBy('position')->groupBy('cat_id');
//            });
        }
        return $CashCardInputVipTemplate;
    }

}
