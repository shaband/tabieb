<?php

namespace App\Http\Requests\Admin\Schedules;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'doctor_id' => 'required|integer|exists:doctors,id',
            'day' => 'required|integer|between:1,7',
            'from_time' => 'required|string',
            'to_time' => 'required|string',
        ];
    }
}
