<?php

namespace App\AppPlugin\UsersApp\Traits;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\UsersApp\Models\UsersApp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

trait UsersAppConfigTraits {

    public function LoadConfig() {
        $config = [
            'UUID' => true,
            'LoginWithSocial' => true,
            'DbTable' => 'users_app',
            'defCountry' => 'eg',
        ];

        $defConfig = [];
        $config = array_merge($config, $defConfig);
        foreach ($config as $key => $value) {
            $this->$key = $value;
        }
        return $config;
    }

    static function DbConfig() {
        $config = new class {
            use UsersAppConfigTraits;
        };
        return $config->LoadConfig();
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getAdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.UsersApp";
        $mainMenu->name = "admin/usersApp.app_menu";
        $mainMenu->icon = "fas fa-user-tie";
        $mainMenu->roleView = "UsersApp_view";
        $mainMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "UsersApp.index|UsersApp.filter";
        $subMenu->url = "admin.UsersApp.index";
        $subMenu->name = "admin/usersApp.app_menu_list";
        $subMenu->roleView = "UsersApp_view";
        $subMenu->icon = "fas fa-list";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "UsersApp.create";
        $subMenu->url = "admin.UsersApp.create";
        $subMenu->name = "admin/usersApp.app_menu_add";
        $subMenu->roleView = "UsersApp_add";
        $subMenu->icon = "fas fa-plus-circle";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "UsersApp.indexArchived|UsersApp.filterArchived";
        $subMenu->url = "admin.UsersApp.indexArchived";
        $subMenu->name = "admin/usersApp.app_menu_list_archived";
        $subMenu->roleView = "UsersApp_view";
        $subMenu->icon = "fas fa-archive";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "UsersApp.report|UsersApp.reportFilter";
        $subMenu->url = "admin.UsersApp.report";
        $subMenu->name = "admin/usersApp.app_menu_report";
        $subMenu->roleView = "UsersApp_report";
        $subMenu->icon = "fas fa-chart-pie";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "UsersApp.export|UsersApp.exportFilter";
        $subMenu->url = "admin.UsersApp.export";
        $subMenu->name = "admin/usersApp.app_menu_export";
        $subMenu->roleView = "UsersApp_export";
        $subMenu->icon = "fas fa-file-export";
        $subMenu->save();

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadDefCategory($Cat) {
//        $Cat['SchoolGender'] = [
//            (object)['id' => 1, 'name' => __('admin/dir_school_var.gender_1')],
//            (object)['id' => 2, 'name' => __('admin/dir_school_var.gender_2'), 'setColor' => '#FF00FF'],
//            (object)['id' => 3, 'name' => __('admin/dir_school_var.gender_3'),],
//        ];
        return $Cat;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function LoadUserProfile() {
        $authUser = Auth::guard('customer')->user();
        $this->authUser = UsersApp::query()->where('id', $authUser->id)->with('photos')->firstOrFail();
        View::share('authUser', $this->authUser);
    }

}
