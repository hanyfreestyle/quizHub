<?php

namespace App\Http\Traits\Files;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\PortalCard\Models\PortalCard;
use Illuminate\Support\Facades\File;

trait PortalCardFileTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadPermission($data) {
        if (File::isFile(base_path('routes/AppPlugin/card/portalCardInput.php'))) {
            $newPer = getDefPermission('PortalCard', []);
            $data = array_merge($data, $newPer);
        }
        return $data;
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadLangFiles($LangMenu) {

        if (File::isFile(base_path('routes/AppPlugin/card/portalCardInput.php'))) {
            $addLang = ['AdminCard' =>
                ['id' => 'AdminCard', 'group' => 'admin', 'file_name' => 'card', 'name' => 'AdminCard', 'name_ar' => 'AdminCard'],
            ];
            $LangMenu = array_merge($LangMenu, $addLang);

            $LangMenu = array_merge($LangMenu, $addLang);

        }

        return $LangMenu;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadSeeder() {
        if (File::isFile(base_path('routes/AppPlugin/card/portalCardInput.php'))) {
            SeedDbFile(PortalCard::class, 'app_card.sql');
            SeedDbFile(PortalCard::class, 'app_card_data.sql');
            SeedDbFile(PortalCard::class, 'app_card_template.sql');
            SeedDbFile(PortalCard::class, 'app_card_input.sql');
            SeedDbFile(PortalCard::class, 'app_card_input_lang.sql');
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadMenu() {
        if (File::isFile(base_path('routes/AppPlugin/card/portalCardInput.php'))) {
            $mainMenu = new AdminMenu();
            $mainMenu->type = "Many";
            $mainMenu->sel_routs = "admin.PortalCard";
            $mainMenu->name = "admin/card.app_menu";
            $mainMenu->icon = "fas fa-address-card";
            $mainMenu->roleView = "PortalCard_view";
            $mainMenu->save();

            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "PortalCard.create";
            $subMenu->url = "admin.PortalCard.create";
            $subMenu->name = "admin/card.app_menu_add";
            $subMenu->roleView = "PortalCard_add";
            $subMenu->icon = "fas fa-plus-circle";
            $subMenu->save();

            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "PortalCard.index";
            $subMenu->url = "admin.PortalCard.index";
            $subMenu->name = "admin/card.app_menu_active";
            $subMenu->roleView = "PortalCard_view";
            $subMenu->icon = "fas fa-list";
            $subMenu->save();

            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "PortalCard.indexVip";
            $subMenu->url = "admin.PortalCard.indexVip";
            $subMenu->name = "admin/card.app_menu_vip";
            $subMenu->roleView = "PortalCard_view";
            $subMenu->icon = "fas fa-star";
            $subMenu->save();

            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "PortalCard.indexDisabled";
            $subMenu->url = "admin.PortalCard.indexDisabled";
            $subMenu->name = "admin/card.app_menu_un_active";
            $subMenu->roleView = "PortalCard_view";
            $subMenu->icon = "fas fa-archive";
            $subMenu->save();

        }
    }

}
