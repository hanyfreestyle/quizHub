<?php

namespace App\Http\Traits\Files;


use App\AppPlugin\UsersApp\Models\UsersApp;
use App\AppPlugin\UsersApp\Traits\UsersAppConfigTraits;
use Illuminate\Support\Facades\File;

trait UsersAppFileTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadPermission($data) {
        if (File::isFile(base_path('routes/usersApp.php'))) {
            $newPer = getDefPermission('UsersApp', ['restore' => true, 'report' => true, 'export' => true]);
            $data = array_merge($data, $newPer);
        }
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadMenu() {
        if (File::isFile(base_path('routes/usersApp.php'))) {
            UsersAppConfigTraits::getAdminMenu();
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadLangFiles($LangMenu) {

        if (File::isFile(base_path('routes/usersApp.php'))) {
            $addLang = ['UsersApp' =>
                ['id' => 'UsersApp', 'group' => 'admin', 'file_name' => 'usersApp', 'name' => 'UsersApp', 'name_ar' => 'UsersApp'],
            ];
            $LangMenu = array_merge($LangMenu, $addLang);


            $addLang = ['UsersAppPortal' =>
                ['id' => 'UsersAppPortal', 'group' => 'portal', 'file_name' => 'auth', 'name' => 'PortalAuth', 'name_ar' => 'PortalAuth'],
            ];
            $LangMenu = array_merge($LangMenu, $addLang);


            $addLang = ['PortalDash' =>
                ['id' => 'PortalDash', 'group' => 'portal', 'file_name' => 'dash', 'name' => 'PortalDash', 'name_ar' => 'PortalDash'],
            ];
            $LangMenu = array_merge($LangMenu, $addLang);

            $addLang = ['PortalSweet' =>
                ['id' => 'PortalSweet', 'group' => 'portal', 'file_name' => 'sweet', 'name' => 'PortalSweet', 'name_ar' => 'PortalSweet'],
            ];
            $LangMenu = array_merge($LangMenu, $addLang);


            $addLang = ['PortalProfile' =>
                ['id' => 'PortalProfile', 'group' => 'portal', 'file_name' => 'profile', 'name' => 'PortalProfile', 'name_ar' => 'PortalProfile'],
            ];
            $LangMenu = array_merge($LangMenu, $addLang);

            $addLang = ['PortalCropper' =>
                ['id' => 'PortalCropper', 'group' => 'portal', 'file_name' => 'cropper', 'name' => 'PortalCropper', 'name_ar' => 'PortalCropper'],
            ];
            $LangMenu = array_merge($LangMenu, $addLang);

            $addLang = ['PortalFields' =>
                ['id' => 'PortalFields', 'group' => 'portal', 'file_name' => 'fields', 'name' => 'PortalFields', 'name_ar' => 'PortalFields'],
            ];
            $LangMenu = array_merge($LangMenu, $addLang);

            $addLang = ['PortalCards' =>
                ['id' => 'PortalCards', 'group' => 'portal', 'file_name' => 'cards', 'name' => 'PortalCards', 'name_ar' => 'PortalCards'],
            ];
            $LangMenu = array_merge($LangMenu, $addLang);


            $addLang = ['PortalCardTemplate' =>
                ['id' => 'PortalCardTemplate', 'group' => 'portal', 'file_name' => 'card_template', 'name' => 'PortalCardTemplate', 'name_ar' => 'PortalCardTemplate'],
            ];
            $LangMenu = array_merge($LangMenu, $addLang);

            $addLang = ['PortalThem' =>
                ['id' => 'PortalThem', 'group' => 'portal', 'file_name' => 'them', 'name' => 'PortalThem', 'name_ar' => 'PortalThem'],
            ];
            $LangMenu = array_merge($LangMenu, $addLang);


            $LangMenu = array_merge($LangMenu, $addLang);

        }

        return $LangMenu;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadSeeder() {
        if (File::isFile(base_path('routes/usersApp.php'))) {
            SeedDbFile(UsersApp::class, 'users_app.sql');
            SeedDbFile(UsersApp::class, 'users_app_lang.sql');
            SeedDbFile(UsersApp::class, 'users_app_photos.sql');
        }
    }


}
