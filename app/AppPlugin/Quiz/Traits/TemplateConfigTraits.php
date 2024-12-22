<?php

namespace App\AppPlugin\PortalCard\Traits;

trait TemplateConfigTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function defTemplateConfig() {

        $defConfig = [
            'mode' => 1, # 1:true | 2:false
            'desk' => 'grid', # list | grid
            'mobile' => 'grid', # list | grid

            'iRadius' => 1, # 1:50% | 2:9px  # iconRadius
            'iColor' => 1, # 1:iconColor | 2:defThemColor  # iconColor
            'iBorder' => 1, # 1:'' | 2:'listRowNoBorder'  # iconBorder
            'iName' => 1, # 1:true | 2:false  # iconName
        ];

        return $defConfig;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function TemplateListArr() {
        $templateList = (object)[
            (object)[
                'id' => 1,
                'layout_id' => 1,
                'name' => __('portal/card_template.app_name_01'),
                'photos' => (object)[
                    'profile' => (object)[
                        'key' => 'profile',
                        'cardH' =>  __('portal/cards.photo_profile_t'),
                        'CardText' =>  __('portal/cards.photo_profile_p'),
                        'aspectRatio' => 1,
                        'width' => 500,
                        'height' => 500,
                        'rang' => '400|2000',
                    ],
                    'cover' => (object)[
                        'key' => 'cover',
                        'cardH' =>  __('portal/cards.photo_cover_t'),
                        'CardText' =>  '',
//                        'CardText' =>  __('portal/cards.photo_cover_p'),
                        'aspectRatio' => 2,
                        'width' => 400,
                        'height' => 200,
                        'rang' => '400|2000',
                    ],
                ],
            ],
            (object)[
                'id' => 2,
                'layout_id' => 2,
                'name' => __('portal/card_template.app_name_02'),
                'photos' => (object)[
                    'profile' => (object)[
                        'key' => 'profile',
                        'cardH' =>  __('portal/cards.photo_profile_t'),
                        'CardText' =>  __('portal/cards.photo_profile_p'),
//                        'aspectRatio' => "2/3",
                        'aspectRatio' => 0,
                        'width' => 520,
                        'height' => 630,
                        'rang' => '300|2000',
                    ],
                ],
            ],
//            (object)[
//                'id' => 3,
//                'layout_id' => 3,
//                'name' => __('portal/card_template.app_name_03'),
//            ],
//            (object)[
//                'id' => 4,
//                'layout_id' => 4,
//                'name' => __('portal/card_template.app_name_04'),
//            ],

        ];
        return collect($templateList);
//        return $templateList;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function loadFormInput() {
        $FormInput = [];


        $FormInput['mode'] = [
            (object)['id' => 1, 'name' => __('portal/card_template.sel_dark_mode_1')],
            (object)['id' => 2, 'name' => __('portal/card_template.sel_dark_mode_2')],
        ];

        $FormInput['GridArr'] = [
            (object)['id' => 'grid', 'name' => __('portal/card_template.sel_grid_arr_grid')],
            (object)['id' => 'list', 'name' => __('portal/card_template.sel_grid_arr_list')],
        ];

        $FormInput['iRadius'] = [
            (object)['id' => '1', 'name' => __('portal/card_template.sel_icon_radius_1')],
            (object)['id' => '2', 'name' => __('portal/card_template.sel_icon_radius_2')],
        ];


        $FormInput['iColor'] = [
            (object)['id' => '1', 'name' => __('portal/card_template.sel_icon_color_1')],
            (object)['id' => '2', 'name' => __('portal/card_template.sel_icon_color_2')],
        ];

        $FormInput['iBorder'] = [
            (object)['id' => '1', 'name' => __('portal/card_template.sel_icon_border_1')],
            (object)['id' => '2', 'name' => __('portal/card_template.sel_icon_border_2')],
        ];

        $FormInput['iName'] = [
            (object)['id' => '1', 'name' => __('portal/card_template.sel_icon_name_1')],
            (object)['id' => '2', 'name' => __('portal/card_template.sel_icon_name_2')],
        ];
        return $FormInput;
    }

}
