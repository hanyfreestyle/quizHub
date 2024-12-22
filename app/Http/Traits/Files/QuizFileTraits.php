<?php

namespace App\Http\Traits\Files;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\PortalCard\Models\PortalCard;
use Illuminate\Support\Facades\File;

trait QuizFileTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadPermission($data) {
        if (File::isFile(base_path('routes/AppPlugin/quiz/quizRoutes.php'))) {
            $newPer = getDefPermission('PortalQuiz', []);
            $data = array_merge($data, $newPer);
        }
        return $data;
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadLangFiles($LangMenu) {

        if (File::isFile(base_path('routes/AppPlugin/quiz/quizRoutes.php'))) {
            $addLang = ['AdminQuiz' =>
                ['id' => 'AdminQuiz', 'group' => 'admin', 'file_name' => 'quiz', 'name' => 'AdminQuiz', 'name_ar' => 'AdminQuiz'],
            ];
            $LangMenu = array_merge($LangMenu, $addLang);

            $LangMenu = array_merge($LangMenu, $addLang);

        }

        return $LangMenu;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadSeeder() {
        if (File::isFile(base_path('routes/AppPlugin/quiz/quizRoutes.php'))) {
            SeedDbFile(PortalCard::class, 'app_quiz_questions.sql');
            SeedDbFile(PortalCard::class, 'app_quiz_answers.sql');

        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadMenu() {
        if (File::isFile(base_path('routes/AppPlugin/quiz/quizRoutes.php'))) {
            $mainMenu = new AdminMenu();
            $mainMenu->type = "Many";
            $mainMenu->sel_routs = "admin.PortalQuiz";
            $mainMenu->name = "admin/quiz.app_menu";
            $mainMenu->icon = "fas fa-address-card";
            $mainMenu->roleView = "PortalQuiz_view";
            $mainMenu->save();

            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "PortalQuiz.create";
            $subMenu->url = "admin.PortalQuiz.create";
            $subMenu->name = "admin/quiz.app_menu_add";
            $subMenu->roleView = "PortalQuiz_add";
            $subMenu->icon = "fas fa-plus-circle";
            $subMenu->save();

            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "PortalQuiz.index";
            $subMenu->url = "admin.PortalQuiz.index";
            $subMenu->name = "admin/quiz.app_menu_list";
            $subMenu->roleView = "PortalQuiz_view";
            $subMenu->icon = "fas fa-list";
            $subMenu->save();
//
//            $subMenu = new AdminMenu();
//            $subMenu->parent_id = $mainMenu->id;
//            $subMenu->sel_routs = "PortalCard.indexVip";
//            $subMenu->url = "admin.PortalCard.indexVip";
//            $subMenu->name = "admin/card.app_menu_vip";
//            $subMenu->roleView = "PortalCard_view";
//            $subMenu->icon = "fas fa-star";
//            $subMenu->save();
//
//            $subMenu = new AdminMenu();
//            $subMenu->parent_id = $mainMenu->id;
//            $subMenu->sel_routs = "PortalCard.indexDisabled";
//            $subMenu->url = "admin.PortalCard.indexDisabled";
//            $subMenu->name = "admin/card.app_menu_un_active";
//            $subMenu->roleView = "PortalCard_view";
//            $subMenu->icon = "fas fa-archive";
//            $subMenu->save();

        }
    }

}
