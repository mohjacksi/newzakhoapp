<?php

namespace App\Http\Requests;

use App\Models\RealEstate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRealEstateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('real_estate_create');
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
