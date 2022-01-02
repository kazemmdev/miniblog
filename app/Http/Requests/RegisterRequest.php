<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => "required|string|max:200",
            "email" => "required|string|email|unique:users,email",
            "password" => "required|string|min:6|confirmed",
        ];
    }

    public function validated()
    {
        return array_merge(
            parent::validated(), [
                'password' => Hash::make(request('password'))
            ]
        );
    }
}
