<?php

namespace App\Http\Requests\Admin\PatientQuestions;

use Illuminate\Foundation\Http\FormRequest;

class PatientQuestionRequest extends FormRequest
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
            'name_ar' => 'required|string|max:191|unique:patient_questions,name_ar,' . $this->patient_question,
            'name_en' => 'required|string|max:191|unique:patient_questions,name_en,' . $this->patient_question,

        ];
    }
}
