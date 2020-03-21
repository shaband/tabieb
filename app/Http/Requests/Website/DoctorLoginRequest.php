<?php

namespace App\Http\Requests\Website;

use App\Rules\CheckPassword;
use Illuminate\Foundation\Http\FormRequest;

class DoctorLoginRequest extends FormRequest
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
            'email'=>'required|email|exits:doctors,email',
            'password'=>['required','string',new CheckPassword('doctors',$this->email)]
        ];
    }
}
