<?php

namespace App\AppPlugin\UsersAppAdmin\Request;

use App\AppPlugin\UsersApp\Models\UsersApp;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UsersAppAdminStoreRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(Request $request): array {
        $id = $this->route('id');
        $phoneCode = $request->countryCode_phone;
        $whatsappCode = $request->countryCode_whatsapp;
        $tableName = "users_app";

        if ($request->form_type == 'Add') {
            $userId = null;
        } elseif ($request->form_type == 'Edit') {
            $userId = UsersApp::query()->where('uuid', $id)->firstOrFail()->id;
        }

        $rules = [
            'name' => "required|min:4|max:50",
        ];

        if ($request->form_type == 'Add') {
            $rules += [
                'phone' => "required|phone:mobile,$phoneCode|unique:$tableName,phone,NULL,id,phone_code," . $phoneCode,
                'whatsapp' => "nullable|phone:mobile,$whatsappCode|unique:$tableName,whatsapp,NULL,id,whatsapp_code," . $whatsappCode,
                'email' => "nullable|email|unique:$tableName,email",
            ];
        } elseif ($request->form_type == 'Edit') {
            $rules += [
                'phone' => "required|phone:mobile,$phoneCode|unique:$tableName,phone," . $userId . ",id,phone_code," . $phoneCode,
                'whatsapp' => "nullable|phone:mobile,$whatsappCode|unique:$tableName,whatsapp," . $userId . ",id,whatsapp_code," . $whatsappCode,
                'email' => "nullable|email|unique:$tableName,email,$userId",
            ];
        }
        return $rules;
    }


    public function messages() {
        return [
            'email.unique' => __('web/profileMass.reg_email_unique'),
            'phone.unique' => __('web/profileMass.reg_phone_unique'),
            'phone.min_digits' => __('web/profileMass.login_phone_err'),
            'phone.max_digits' => __('web/profileMass.login_phone_err'),
        ];
    }

}
