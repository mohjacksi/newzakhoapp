<?php

namespace App\Http\Requests;

use App\Models\AppSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAppSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('app_setting_create');
    }

    public function rules()
    {
        return [
            'key'           => [
                'string',
                'required',
                'unique:app_settings',
            ],
            'value_english' => [
                'string',
                'nullable',
            ],
            'value_arabic'  => [
                'string',
                'nullable',
            ],
            'value_kurdish' => [
                'string',
                'nullable',
            ],
        ];
    }
}
