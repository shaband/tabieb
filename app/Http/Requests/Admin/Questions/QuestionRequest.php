<?php

namespace App\Http\Requests\Admin\Questions;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'name_ar' => 'required|string|max:191|unique:questions,name_ar,' . $this->question,
            'name_en' => 'required|string|max:191|unique:questions,name_en,' . $this->question,
            'answer_ar' => 'required|string|',
            'answer_en' => 'required|string|'
        ];
    }
}
