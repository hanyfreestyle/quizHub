<?php

namespace App\AppPlugin\UsersApp\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ForgetPasswordRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(Request $request): array {

        $tableName = "users_app";


        $rules = [
            'email' => "required|email|regex:/^[\w\._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/|exists:users_app",
        ];


        return $rules;
    }


    public function messages() {
        return [
            'email.exists' => __('portal/auth.err_login_exists'),
        ];
    }

}
