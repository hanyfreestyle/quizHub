<?php

namespace App\AppPlugin\UsersApp\Request;

use Illuminate\Foundation\Http\FormRequest;

class UsersProfilePasswordUpdateRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'old_password' => "required|min:8",
            'password' => "required|min:8|confirmed",
        ];
    }

    public function messages() {
        return [

        ];
    }
}
