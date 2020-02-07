<?php

namespace App\Http\Requests\Admin\SocialSecurities;

use Illuminate\Foundation\Http\FormRequest;

class SocialSecurityRequest extends FormRequest
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
            'name_ar' => 'required|string|max:191|unique:social_securities,name_ar,' . $this->social_security,
            'name_en' => 'required|string|max:191|unique:social_securities,name_en,' . $this->social_security,

        ];
    }
}
