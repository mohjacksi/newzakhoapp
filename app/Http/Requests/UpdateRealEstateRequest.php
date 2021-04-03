<?php

namespace App\Http\Requests;

use App\Models\RealEstate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRealEstateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('real_estate_edit');
    }

    public function rules()
    {
        return [
            'title_english' => [
                'string',
                'nullable',
            ],
            'title_arabic'  => [
                'string',
                'nullable',
            ],
            'title_kurdish' => [
                'string',
                'nullable',
            ],
        ];
    }
}
