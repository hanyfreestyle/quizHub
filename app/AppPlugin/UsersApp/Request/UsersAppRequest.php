<?php

namespace App\AppPlugin\UsersApp\Request;

use Illuminate\Foundation\Http\FormRequest;

class UsersAppRequest extends FormRequest {

    protected $redirectRoute = "portal.login";

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'email' => "required|email|regex:/^[\w\._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/|exists:users_app",
            'password' => "required|min:8",
        ];
    }

    public function messages() {
        return [
            'email.exists' => __('portal/auth.err_login_exists'),

        ];
    }

    public function redirect() {
        return redirect()->route('login');
    }
}
