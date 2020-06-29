<?php

namespace App\Models;

use App\Repositories\interfaces\AttachmentRepository;
use App\Repositories\interfaces\TransactionRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transaction extends Model
{

    const PAYMENT_TYPE_DEBIT = 0;
    const PAYMENT_TYPE_CREDIT = 1;

    protected $fillable = [
        'gateway',
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
        'description',
        'credit_transaction_id',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo('model');
    }

    public function creditTransaction(): HasOne
    {

        return $this->hasOne(Transaction::class, 'credit_transaction_id')->withDefault(new Transaction());
    }

    public function DebitTransaction(): BelongsTo
    {

        return $this->belongsTo(Transaction::class, 'credit_transaction_id');
    }

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function scopeOfWallet(Builder $builder)
    {

        $builder->where('gateway', 'wallet');
    }

    public function scopeOfModelType(Builder $builder, Model $model): void
    {

        if ($model instanceof Model) {
            $model = app(TransactionRepository::class)
                ->getMorphedAlias((new \ReflectionClass($model))->getName());
        }
        $builder->where('model_type', $model);
    }


    public function scopeOfUserWallet(Builder $builder, Model $model): void
    {
        $builder->limit(1)
            ->selectRaw(
                'SUM(CASE
                                  WHEN payment_type = 0 THEN amount
                                  ELSE  (amount * -1)
                                END )as total_amount')
            ->OfModelType($model)
            ->OfWallet()
         //   ->where('model_id', $model_id)
            ->latest();
    }

    public function scopeTotalAmount(Builder $builder)
    {
        $builder->selectRaw('SUM(amount) as total_amount');
    }


}
