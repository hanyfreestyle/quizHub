<?php

namespace App\AppPlugin\UsersApp\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersProfileUpdateRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(Request $request): array {


        $tableName = "users_app";
        $phoneCode = $request->countryCode_phone;
        $whatsappCode = $request->countryCode_whatsapp;
        $userId = Auth::guard('customer')->user()->id;

        return [
            'name' => "required|min:4|max:50",
//            'email' => "required|email|unique:$tableName,email,$userId",
            'phone' => "nullable|phone:mobile,$whatsappCode|unique:$tableName,phone," . $userId . ",id,phone_code," . $phoneCode,
            'whatsapp' => "nullable|phone:mobile,$whatsappCode|unique:$tableName,whatsapp," . $userId . ",id,whatsapp_code," . $whatsappCode,

        ];

    }

    public function messages() {
        return [
//            'email.unique' => __('web/profileMass.reg_email_unique'),
//            'phone.min_digits' => __('web/profileMass.login_phone_err'),
//            'phone.max_digits' => __('web/profileMass.login_phone_err'),
        ];
    }

}
