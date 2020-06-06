<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
{


    public function validationData()
    {
        return $this->IncludeReservationId();
    }

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
            'reservation_id' => 'required|integer|exists:reservations,id,patient_id,' . auth()->user()->id,
            'description' => 'nullable|string',
            'rate' => 'required|integer|min:0|max:5'
        ];
    }

    private function IncludeReservationId(): array
    {
        $data = parent::validationData();
        if (!isset($data['reservation_id'])) {
            $data['reservation_id'] = $this->reservation_id;
        }
        return $data;
    }

}
