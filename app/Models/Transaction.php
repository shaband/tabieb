<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transaction extends Model
{
    protected $fillable = ['gateway',
        'invoice_id',
        'amount',
        'currency',
        'transaction_id',
        'card_brand',
        'card_first_six_digits',
        'card_last_six_digits',
        'card_last_four_digits',
        'response_code',
        'model_type',
        'model_id',
        'payment_type',
        'reservation_id',
        'doctor_id',

        ];

    public function model(): MorphTo
    {
        return $this->morphTo('model');
    }

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }
    public  function  doctor():BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}
