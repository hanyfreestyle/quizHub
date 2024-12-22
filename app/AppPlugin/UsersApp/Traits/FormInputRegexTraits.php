<?php

namespace App\AppPlugin\UsersApp\Traits;

trait FormInputRegexTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function checkFormData($row) {
        $form['t_value'] = __('portal/cards.fr_data_value_url');
        $form['t_label'] = __('portal/cards.fr_data_label');
        $form['css'] = 'input_dir_en lang_en';
        $form['inputType'] = 'text';
        $form['req'] = ' required ';
        $form['req_label'] = ' required ';
        if (thisCurrentLocale() == 'ar') {
            $errMass = $row->err_ar;
        } else {
            $errMass = $row->err_en;
        }

        if ($row->type == 'email') {
            $form['t_value'] = __('portal/cards.fr_data_value_email');
            $form['inputType'] = 'email';
            $form['req'] = ' required   pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"  data-parsley-error-message="' . $errMass . '"';
        } elseif ($row->type == 'url') {
            $form['inputType'] = 'url';
            if ($row->regex) {
                $form['req'] = ' required type="url" data-parsley-type="url" pattern="' . $row->regex . '"  data-parsley-error-message="' . $errMass . '"';
            } else {
                $form['req'] = ' required  type="url" data-parsley-type="url" pattern="^(https?):\/\/[^\s/$.?#].[^\s]*$" data-parsley-error-message="' . __('portal/cards.mass_err_url') . '"';
            }
        } elseif ($row->type == 'number') {
            $form['inputType'] = 'tel';
            $form['t_value'] = "رقم الهاتف";
            $form['t_value'] = self::checkValueName($form['t_value'],$row);
            if ($row->regex) {
                $form['req'] = ' required  pattern="' . $row->regex . '"  data-parsley-error-message="' . $errMass . '"';
            } else {
                $form['req'] = ' required  pattern="^\+?\d{7,25}$" data-parsley-error-message="' . __('portal/cards.mass_err_url') . '"';
            }

        } elseif ($row->type == 'text') {
//            $form['css'] = '';
//            $form['t_value'] = self::checkValueName($row);
//            $form['req'] = self::checkPatternText($row);
        }

        return $form;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function checkValueName($def,$row) {
        if ($row->input_id == 'WhatsApp') {
            return $row->name;
        } elseif ($row->input_id == 'WhatsApp') {
            $name = ' رقم الوتس اب ';
        } else {
            $name = $row->name;
        }
        return $def;
    }
}
