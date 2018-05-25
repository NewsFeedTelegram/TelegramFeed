<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    use AjaxResponse;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'login' => 'required|string|max:50|unique:users',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
