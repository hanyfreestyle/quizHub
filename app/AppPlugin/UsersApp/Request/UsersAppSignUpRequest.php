<?php

namespace App\AppPlugin\UsersApp\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UsersAppSignUpRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(Request $request): array {

        $tableName = "users_app";
//        $phoneCode = $request->countryCode_phone;

        $rules = [
            'name' => "required|min:4|max:50",
//            'phone' => "required|phone:mobile,$phoneCode|unique:$tableName,phone,NULL,id,phone_code," . $phoneCode,
            'email' => "required|email|regex:/^[\w\._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/|unique:$tableName,email",
            'password' => "required|min:8|confirmed",
            'terms' => "required",
        ];

        return $rules;
    }


    public function messages() {
        return [
            'email.unique' => __('portal/auth.err_email_unique'),
            'terms' => __('portal/auth.err_terms'),
        ];
    }

}
