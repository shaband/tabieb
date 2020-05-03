<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class ChatRequest extends FormRequest
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
        return parent::validationData() + ['chat_id' => $this->chat_id];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'chat_id' => 'required|integer|exists:chats,id,doctor_id,' . auth()->id(),
            'message' => 'required|string',
            'file' => 'nullable|image'
        ];
    }
}
