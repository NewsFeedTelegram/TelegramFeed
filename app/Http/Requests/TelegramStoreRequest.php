<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TelegramStoreRequest extends FormRequest
{
    use AjaxResponse;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'link' => 'required|max:50'
        ];
    }
}
