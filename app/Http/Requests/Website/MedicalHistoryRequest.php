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

    public function validationData()
    {
        $data = parent::validationData();
        $this->addPatientIdIfInAuth($data);
        return $data;
    }

    /**
     * check if  there is patient id from request don't  overwrite it
     * add patient_id form the auth  session  if exists on guards  patient or patient_api
     * @param array $data
     */
    public function addPatientIdIfInAuth(array &$data)
    {

        if (
            !isset($data['patient_id'])
            &&
            auth()->guard('patient')->check()
            ||
            auth()->guard('patient_api')->check()
        ) {
            $data['patient_id'] = auth()->id();
        }
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
            'image' => 'nullable|mimes:jpeg,bmp,png,jpg,svg,pdf',
            'date' => 'nullable|date',


        ];
    }
}
