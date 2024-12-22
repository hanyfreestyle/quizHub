<?php
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getCardName')) {
    function getCardName($card) {
        return $card->prefix . " " . $card->first_name . " " . $card->last_name;
    }
}
if (!function_exists('getJobTitle')) {
    function getJobTitle($card) {
        if ($card->job_title) {
            return $card->job_title;
        } else {
            return __('portal/cards.mass_no_job_title');
        }

    }
}

if (!function_exists('cardEditMenu')) {
    function cardEditMenu($Route, $selRoute) {
        if ($selRoute == $Route) {
            return ' active';
        } else {
            return null;
        }
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getThemLang')) {
    function getThemLang($card) {
        if ($card->lang == 'ar') {
            return 'dir="rtl"';
        } else {
            return null;
        }
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getCardLink')) {
    function getCardLink($data) {
        if ($data->input_info->type == 'url') {
            return $data->value;
        } elseif ($data->input_info->type == 'email') {
            return 'mailto:' . $data->value;
        } elseif ($data->input_info->type == 'number') {
            if ($data->input_info->input_id == 'Phone') {
                return 'tel:' . $data->value;
            } elseif ($data->input_info->input_id == 'WhatsApp') {
                return 'https://wa.me/' . $data->value;
            } elseif ($data->input_info->input_id == 'Viber') {
                return 'viber://chat?number=' . $data->value;
            } elseif ($data->input_info->input_id == 'Telegram') {
                return 'https://t.me/' . $data->value;
            }
        }
    }
}

if (!function_exists('getCardLinkInfo')) {
    function getCardLinkInfo($data) {
        $print = '<h4>' . $data->label . '</h4>';
        if ($data->input_info->type == 'url') {

        } elseif ($data->input_info->type == 'email') {
            $print = '<h4 class="number">' . $data->value . '</h4>';
            $print .= '<address>' . $data->label . '</address>';
        } elseif ($data->input_info->type == 'number') {
            if ($data->input_info->input_id == 'Phone') {
                $print = '<h4 class="number">' . $data->value . '</h4>';
                $print .= '<address>' . $data->label . '</address>';
            } elseif ($data->input_info->input_id == 'WhatsApp') {

            } elseif ($data->input_info->input_id == 'Phone') {

            }
        }


        return $print;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('generateWhatsappLink')) {
    function generateWhatsappLink($url, $message = null) {
        $prefix = 'https://profilehub.me/c/';
        $message = "I am happy to share with you all communication methods via this link.";
        // ترميز الرسالة والرابط باستخدام URL encoding
        $encodedMessage = urlencode($message);
        $encodedUrl = urlencode($prefix . $url);

        // توليد رابط WhatsApp
        return "https://wa.me/?text={$encodedMessage}%20{$encodedUrl}";
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('printViewCardTemp')) {
    function printViewCardTemp($card) {
        return '<div class="menu__cardMenuEyeFixed"><a href="' . route('web.card.cardView', $card->slug) . '" class="" target="_blank">
        <i class="fa-solid fa-eye"></i></a></div>';
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
