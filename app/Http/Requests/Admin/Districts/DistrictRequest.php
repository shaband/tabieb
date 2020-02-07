<?php

namespace App\Http\Requests\Admin\Districts;

use Illuminate\Foundation\Http\FormRequest;

class DistrictRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar' => 'required|string|unique:districts,name_ar' ,
            'name_en' => 'required|string|unique:districts,name_en' ,
        ];
    }
}
