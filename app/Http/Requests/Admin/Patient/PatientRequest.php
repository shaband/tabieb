<?php

namespace App\Http\Requests\Admin\Patient;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'username' => 'nullable|string|max:191',
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'email' => 'required|email|unique:patients,email,' . $this->patient,
            'phone' => 'required|numeric|unique:patients,phone,' . $this->patient,
            'password' => 'nullable|required_without:_method|string|max:191|confirmed',
            'civil_id' => 'required|numeric|unique:patients,civil_id,' . $this->patient,
            'social_security_id' => 'nullable|integer|exists:social_securities,id',
            'birthdate' => 'nullable|date|date_format:Y-m-d',
            'district_id' => 'nullable|integer|exists:districts,id',
            'area_id' => 'nullable|integer|exists:areas,id',
            'block_id' => 'nullable|integer|exists:blocks,id',
            'gender' => 'nullable|integer|min:1|max:2',
        ];
    }
}
