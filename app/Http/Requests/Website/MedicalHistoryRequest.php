<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class MedicalHistoryRequest extends FormRequest
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
            'title' => 'required|string|max:191',
            'description' => 'nullable|string',
            'patient_id' => 'required|integer|exists:patients,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'image' => 'nullable|image',
            'date' => 'nullable|date',
        ];
    }
}
