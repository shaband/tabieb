<?php

namespace App\Http\Requests\Admin\Doctors;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
            "first_name_ar" => "required|string|max:191",
            "last_name_ar" => "required|string|max:191",
            "first_name_en" => "required|string|max:191",
            "last_name_en" => "required|string|max:191",
            "description_ar" => "nullable|string",
            "description_en" => "nullable|string",
            "title_ar" => "required|string|max:191",
            "title_en" => "required|string|max:191",
            "civil_id" => "required|numeric",
            "price" => "nullable|numeric",
            "period" => "nullable|numeric",
            "category_id" => 'required|integer|exists:categories,id,category_id,NULL',
            "sub_category_ids" => 'nullable|array',
            "sub_category_ids.*" => 'nullable|exists:categories,id,category_id,' . $this->category_id,
            'email' => 'required|email|max:191|unique:doctors,id,' . $this->doctor,
            'password' => 'nullable|required_without:_method|string|max:191|confirmed',
            'phone' => 'required|numeric|unique:doctors,phone,' . $this->doctor,
            'image' => 'nullable|image',
        ];
    }
}
