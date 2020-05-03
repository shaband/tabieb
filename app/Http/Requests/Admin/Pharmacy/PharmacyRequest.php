<?php

namespace App\Http\Requests\Admin\Pharmacy;

use Illuminate\Foundation\Http\FormRequest;

class PharmacyRequest extends FormRequest
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
            'name_ar' => 'required|string|max:191',
            'name_en' => 'required|string|max:191',
            'email' => 'required|email|unique:pharmacies,email,' . $this->pharmacy,
            'phone' => 'required|numeric|unique:pharmacies,phone,' . $this->pharmacy,
            //   'district_id' => 'nullable|integer|exists:districts,id',
            //    'area_id' => 'nullable|integer|exists:areas,id',
            //     'block_id' => 'nullable|integer|exists:blocks,id',
            'address_ar' => 'required|string|max:191',
            'address_en' => 'required|string|max:191',
        ];
    }
}
