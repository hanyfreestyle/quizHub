<?php

namespace App\AppPlugin\UsersApp\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UsersProfileAddressAddRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(Request $request): array {

        $phoneCode = strtoupper($request->input('countryCode_phone'));
        $phoneOptionCode = strtoupper($request->input('countryCode_phone_option'));

        return [
            'recipient_name' => "required|min:4|max:50",
            'phone' => "required|phone:mobile,$phoneCode",
            'phone_option' => "nullable|different:phone|phone:$phoneOptionCode",
            'address' => "required|min:10|max:250",
        ];
    }


    public function messages() {
        return [
            'phone_option.min_digits' => __('web/profileMass.login_phone_err'),
            'phone_option.max_digits' => __('web/profileMass.login_phone_err'),
            'phone.min_digits' => __('web/profileMass.login_phone_err'),
            'phone.max_digits' => __('web/profileMass.login_phone_err'),
        ];
    }

}
