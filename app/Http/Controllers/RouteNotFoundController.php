<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class RouteNotFoundController extends Controller {
    public function __invoke() {
        $adminDir = config('app.configAdminDir');
        $currentSlug = Route::current()->originalParameters();
        if (isset($currentSlug['fallbackPlaceholder']) and mb_substr($currentSlug['fallbackPlaceholder'], 0, strlen($adminDir)) == $adminDir) {
            abort('410');
        } else {
            if (config('app.WEB_VIEW')) {
                $Meta = [];
                $w = new WebMainController();
                $w->printSeoMeta($Meta);

                $pageView = [
                    'SelMenu' => '',
                    'show_fix' => true,
                    'slug' => null,
                    'go_home' => route('web.index'),
                ];
                View::share('pageView', $pageView);
                abort('404');
            } else {
                abort('412');
            }
        }
    }
}
