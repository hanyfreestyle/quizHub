<?php

namespace App\Http\Traits;

use App\AppPlugin\Crm\CrmService\CrmServiceTraits;
use App\AppPlugin\Crm\Customers\Traits\CrmCustomersConfigTraits;
use App\AppPlugin\DirSchool\Traits\DirSchoolConfigTraits;
use Illuminate\Support\Facades\File;

trait DefCategoryTraits {

    static function LoadCategory() {
        $Cat = [];

        $Cat['PortalInputCategory'] = [
            (object)['id' => 1, 'name' => __('admin/portalCard.var_input_cat_1'), 'parentCard' => 'general_input', 'icon' => 'fas fa-cogs'],
            (object)['id' => 2, 'name' => __('admin/portalCard.var_input_cat_2'), 'parentCard' => 'business_input', 'icon' => 'fas fa-briefcase'],
            (object)['id' => 3, 'name' => __('admin/portalCard.var_input_cat_3'), 'parentCard' => 'social_input', 'icon' => 'fas fa-share-alt'],
            (object)['id' => 4, 'name' => __('admin/portalCard.var_input_cat_4'), 'parentCard' => 'messaging_input', 'icon' => 'fas fa-comment-dots'],
        ];
        $Cat['gender'] = [
            (object)['id' => 1, 'name' => __('admin/defCat.gender_1')],
            (object)['id' => 2, 'name' => __('admin/defCat.gender_2'), 'setColor' => '#FF00FF'],
        ];

        $Cat['month'] = [
            (object)['id' => 1, "name" => __('admin/defCat.month_1')],
            (object)['id' => 2, "name" => __('admin/defCat.month_2')],
            (object)['id' => 3, "name" => __('admin/defCat.month_3')],
            (object)['id' => 4, "name" => __('admin/defCat.month_4')],
            (object)['id' => 5, "name" => __('admin/defCat.month_5')],
            (object)['id' => 6, "name" => __('admin/defCat.month_6')],
            (object)['id' => 7, "name" => __('admin/defCat.month_7')],
            (object)['id' => 8, "name" => __('admin/defCat.month_8')],
            (object)['id' => 9, "name" => __('admin/defCat.month_9')],
            (object)['id' => 10, "name" => __('admin/defCat.month_10')],
            (object)['id' => 11, "name" => __('admin/defCat.month_11')],
            (object)['id' => 12, "name" => __('admin/defCat.month_12')],
        ];

        $Cat['ContinentArr'] = [
            ['id' => 'AS', 'name' => __('admin/dataCountry.continent_as')],
            ['id' => 'EU', 'name' => __('admin/dataCountry.continent_eu')],
            ['id' => 'AF', 'name' => __('admin/dataCountry.continent_af')],
            ['id' => 'OC', 'name' => __('admin/dataCountry.continent_oc')],
            ['id' => 'NA', 'name' => __('admin/dataCountry.continent_na')],
            ['id' => 'AN', 'name' => __('admin/dataCountry.continent_an')],
            ['id' => 'SA', 'name' => __('admin/dataCountry.continent_sa')],
        ];

        $Cat['FilterTypeArr'] = [
            (object)['id' => '1', 'name' => __('admin/config/upFilter.filter_action_1')],
            (object)['id' => '2', 'name' => __('admin/config/upFilter.filter_action_2')],
            (object)['id' => '3', 'name' => __('admin/config/upFilter.filter_action_3')],
            (object)['id' => '4', 'name' => __('admin/config/upFilter.filter_action_4')],
            (object)['id' => '5', 'name' => __('admin/config/upFilter.filter_action_5')],
        ];

        $Cat['PrintPhotoPosition'] = [
            ['id' => '1', 'name' => "Top"],
            ['id' => '2', 'name' => "Bottom"],
        ];

        $Cat['WebSearchTypeArr'] = [
            ['id' => '1', 'name' => __('admin/config/webConfig.web_serach_type_1')],
            ['id' => '2', 'name' => __('admin/config/webConfig.web_serach_type_2')],
        ];


        $Cat['filter_card_open'] = [
            (object)['id' => '0', 'name' => __('admin/defCat.filter_card_open_0')],
            (object)['id' => '1', 'name' => __('admin/defCat.filter_card_open_1')],
        ];

        $Cat['filter_last_add'] = [
            (object)['id' => '0', 'name' => __('admin/defCat.filter_last_add_0')],
            (object)['id' => '1', 'name' => __('admin/defCat.filter_last_add_1')],
        ];

        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
            $Cat = CrmCustomersConfigTraits::LoadDefCategory($Cat);
        }

        if (File::isFile(base_path('routes/AppPlugin/CrmService/leads.php'))) {
            $Cat = CrmServiceTraits::LoadDefCategory($Cat);
        }

        if (File::isFile(base_path('routes/AppPlugin/dir/school.php'))) {
            $Cat = DirSchoolConfigTraits::LoadDefCategory($Cat);
        }

        return $Cat;
    }


}
