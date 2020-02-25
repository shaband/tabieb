<?php

namespace App\Http\Requests\Admin\PharmacyReps;

use Illuminate\Foundation\Http\FormRequest;

class PharmacyRepRequest extends FormRequest
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
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:pharmacy_reps,id,' . $this->pharmacy_rep,
            'password' => 'nullable|required_without:_method|string|max:191|confirmed',
            'phone' => '|required_without:_method|required|numeric|unique:pharmacy_reps,phone,' . $this->pharmacy_rep,
            'image' => 'nullable|image',
        ];
    }
}
