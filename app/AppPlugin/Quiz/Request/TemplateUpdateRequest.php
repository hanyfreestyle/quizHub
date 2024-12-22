<?php

namespace App\AppPlugin\PortalCard\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TemplateUpdateRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(Request $request): array {



        $rules = [
            'color' => 'required',
            'mode' => 'required|in:1,2',
            'desk' => 'required|string|in:grid,list',
            'mobile' => 'required|string|in:grid,list',
            'iRadius' => 'required|in:1,2',
            'iColor' => 'required|in:1,2',
            'iBorder' => 'required|in:1,2',
            'iName' => 'required|in:1,2',
        ];

        return $rules;
    }


    public function messages() {
        return [
            'email.exists' => __('portal/auth.err_login_exists'),
        ];
    }

}
