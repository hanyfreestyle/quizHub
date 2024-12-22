<?php

namespace App\AppPlugin\PortalCard\Admin;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PortalCardInputRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(Request $request): array {


        $id = $this->route('id');

        $rules = [
            'cat_id' => "required",
            'name_key' => 'required',
            'type' => 'required',
            'input_dir' => 'required',
            'icon_i' => 'required',
            'url' => 'nullable|url',
            'url_user' => 'nullable|url',
//            'regex' => 'nullable',
//            'err_ar' => 'nullable|required_with:regex',
//            'err_en' => 'nullable|required_with:err_ar',
        ];

        if ($id == '0') {
            $rules += [
                'input_id' => 'required|alpha_dash:ascii|min:3|max:50|unique:app_card_input',
            ];
        } else {
            $rules += [
                'input_id' => "required|alpha_dash:ascii|min:3|max:50|unique:app_card_input,input_id,$id",
            ];
        }

        foreach (config('app.web_lang') as $key => $lang) {
            $rules[$key . ".name"] = "required";
        }

        return $rules;
    }
}



