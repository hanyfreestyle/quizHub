<?php

namespace App\AppPlugin\Quiz\Traits;

trait QuizConfigTraits {

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
    static function loadQuizCat() {
        $quizCat = [];

        $quizCat['classes'] = [
            (object)['id' => 1, 'name' => 'اسم الصف'],

        ];

        $quizCat['subjects'] = [
            (object)['id' => '1','name' =>'دراسات'],
            (object)['id' => '2', 'name' =>'عربى'],
        ];

        $quizCat['terms'] = [
            (object)['id' => '1', 'name' => 'الفصل الدراسى الاول'],
            (object)['id' => '2', 'name' => 'الفصل الدراسى الثانى'],
        ];


        $quizCat['units'] = [
            (object)['id' => 1, 'name' => 'الوحدة الأولى'],
            (object)['id' => 2, 'name' => 'الوحدة الثانية'],
            (object)['id' => 3, 'name' => 'الوحدة الثالثة'],
            (object)['id' => 4, 'name' => 'الوحدة الرابعة'],
            (object)['id' => 5, 'name' => 'الوحدة الخامسة'],
            (object)['id' => 6, 'name' => 'الوحدة السادسة'],
        ];

        $quizCat['sections'] = [
            (object)['id' => '1', 'name' => 'اختر الاجابات الصحيحه'],
            (object)['id' => '2', 'name' => 'الصواب والخطا'],
            (object)['id' => '3', 'name' => 'بما تفسر'],
            (object)['id' => '4', 'name' => 'ما هى النتائج المترتبة على '],
        ];

        return $quizCat;
    }

}
