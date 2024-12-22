<?php

namespace App\AppCore\Menu;

use App\AppCore\AdminRole\PermissionController;
use App\AppCore\LangFile\LangFileController;
use App\Http\Traits\Files\AppSettingFileTraits;
use App\Http\Traits\Files\DataFileTraits;
use App\Http\Traits\Files\MainModelFileTraits;
use App\Http\Traits\Files\PortalCardFileTraits;
use App\Http\Traits\Files\UsersAppFileTraits;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;


class AdminMenuSeeder extends Seeder {

    public function run(): void {

        PermissionController::AdminMenu();
        AppSettingFileTraits::LoadMenu();
        DataFileTraits::LoadMenu();
        LangFileController::AdminMenu();
        UsersAppFileTraits::LoadMenu();
        PortalCardFileTraits::LoadMenu();
        MainModelFileTraits::LoadMenu();

        $updateMenuPosition = AdminMenu::query()->where('parent_id', '!=', null)->get();

        foreach ($updateMenuPosition as $menu) {
            $menu->position = $menu->id;
            $menu->save();
        }

        $moveMenu = false;
        $menuView = "crm_service_cash_view";
        if ($moveMenu) {
            $updateMenuPosition = AdminMenu::query()->where('type', 'Many')->get();
            foreach ($updateMenuPosition as $menu) {
                if ($menu->roleView == $menuView) {
                    $menu->position = 1;
                } else {
                    $menu->position = $menu->id + 1;
                }
                $menu->save();
            }
        }

        Cache::forget('CashAdminMenuList');
    }
}
