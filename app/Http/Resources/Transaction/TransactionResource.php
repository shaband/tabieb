<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'gateway'=>$this->gateway,
            'invoice_id'=>$this->invoice_id,
            'amount'=>$this->amount,
            'currency'=>$this->currency,
            'transaction_id'=>$this->transaction_id,
            'card_brand'=>$this->card_brand,
            'card_first_six_digits'=>$this->card_first_six_digits,
            'card_last_six_digits'=>$this->card_last_six_digits,
            'card_last_four_digits'=>$this->card_last_four_digits,
            'response_code'=>$this->response_code,
            'model_type'=>$this->model_type,
            'model_id'=>$this->model_id,
            'payment_type'=>$this->payment_type,
            'reservation_id'=>$this->reservation_id,
            'doctor_id'=>$this->doctor_id,
            'description'=>$this->description,
            'credit_transaction_id'=>$this->credit_transaction_id,

        ];
    }
}
