<?php
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('updateNameAr')) {
    function updateNameAr($rowData, $lang, $arabic, $name) {
        if ($lang == 'ar') {
            return $arabic->utf8Glyphs($rowData->translate($lang)->$name);
        } else {
            return $rowData->translate($lang)->$name;
        }
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('resumeName')) {
    function resumeName($rowData, $lang, $arabic) {
        if ($rowData->cv_name) {
            $nameIs = $rowData->cv_name ;
        } else {
            $fullName = $rowData->translate($lang)->name ?? null;
            $fullName = explode(' ', $fullName);
            $fullName = array_filter($fullName);
            $fullName = array_values($fullName);
            $firstName = $fullName[0];
            $lastName = end($fullName);
            $nameIs = $firstName . " " . $lastName;
        }
        if ($lang == 'ar') {
            return $arabic->utf8Glyphs($nameIs);
        } else {
            return $nameIs;
        }
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getLangVar')) {
    function getLangVar($lang) {
        if ($lang == 'ar') {
            $langVar = (object)[
                'email' => 'البريد الالكترونى',
                'h_contact_me' => 'معلومات الاتصال',
                'h_references' => 'المراجع',
                'linkedin' => 'لنكدان',
                'mobile' => 'رقم الجوال',
                'website' => 'الموقع الالكترونى',
                'whatsapp' => 'واتس اب',
            ];
        } else {
            $langVar = (object)[
                'email' => 'E-Mail',
                'h_contact_me' => 'Contact Me',
                'h_references' => 'References',
                'linkedin' => 'LinkedIn',
                'mobile' => 'Mobile',
                'website' => 'Web Site',
                'whatsapp' => 'Whatsapp',
            ];
        }

        $data = collect($langVar);
        return $langVar;
    }
}










#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
