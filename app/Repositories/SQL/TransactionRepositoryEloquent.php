<?php

namespace App\Repositories\SQL;

use App\Models\Patient;
use App\Models\Reservation;
use App\Repositories\SQL\BaseRepository;
use App\Services\Facades\PayTabs;
use Illuminate\Validation\ValidationException;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\TransactionRepository;
use App\Models\Transaction;

// use App\Validators\TransactionValidator;

/**
 * Class TransactionRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class TransactionRepositoryEloquent extends BaseRepository implements TransactionRepository
{


    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Transaction::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $transaction_id
     * @param Reservation $reservation
     * @return Transaction
     * @throws ValidationException
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store($transaction_id, Reservation $reservation): Transaction
    {
        $payTabs_data = PayTabs::verify_transaction($transaction_id);


        ['model_type' => $model_type, 'model_id' => $model_id, 'reservation_id' => $reservation_id] = self::decodeOrderId($payTabs_data['order_id']);

        return $this->CreatePayTabTransaction($payTabs_data, $model_type, $model_id, $reservation);
    }


    public function PayFromWallet($amount, Reservation $reservation): Transaction
    {
        $attributes = [
            'gateway' => 'wallet',
            'amount' => $amount,
            'currency' => "SAR",
            'card_brand' => 'wallet',
            'model_type' => $this->getMorphedAlias((new \ReflectionClass(Patient::class))->getName()),
            'model_id' => $reservation->patient->id,
            'payment_type' => Transaction::PAYMENT_TYPE_CREDIT,
            'reservation_id' => $reservation->id,
            'doctor_id' => $reservation->doctor_id,
        ];

        return $this->create($attributes);

    }

    public function PayBackToWallet(Transaction $transaction, $description = null): Transaction
    {
        $attributes = [
            'gateway' => 'wallet',
            'amount' => $transaction->amount,
            'currency' => "SAR",
            'card_brand' => 'wallet',
            'model_type' => $transaction->model_type,
            'model_id' => $transaction->model_id,
            'payment_type' => Transaction::PAYMENT_TYPE_DEBIT,
            'reservation_id' => $transaction->reservation_id,
            'doctor_id' => $transaction->doctor_id,
            'description' => $description,
        ];

        return $this->create($attributes);

    }


    /**
     * decode the json of order id
     * @param $payTabs_data
     * @return mixed
     */
    public static function decodeOrderId($order_id)
    {
        $data = json_decode(str_replace('\\', '', $order_id), true);
        //if is decode null set default auth value and set reservation it to order_id (عشان خاطر حب الحبايب )
        if (!is_array($data)) {
            $data = [
                'model_id' => auth()->id(),
                'model_type' => 'patients',
                'reservation_id' => $order_id

            ];

        }
        return $data;
    }

    /**
     * @param $user
     * @param int $payment_type
     * @return mixed
     */
    public function getTotalUserTransaction($user)
    {

        return $this->model->groupBy('model_id')->where('model_id', $user->id)->OfUserWallet($user)->first()->total_amount ?? 0;
    }

    /**
     * @param $payTabs_data
     * @param $model_type
     * @param $model_id
     * @param Reservation $reservation
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function CreatePayTabTransaction($payTabs_data, $model_type, $model_id, Reservation $reservation): Transaction
    {
        $attributes = [
            'gateway' => 'payTabs',
            'invoice_id' => $payTabs_data['pt_invoice_id'],
            'amount' => $payTabs_data['amount'],
            'currency' => $payTabs_data['currency'],
            'transaction_id' => $payTabs_data['transaction_id'],
            'card_brand' => $payTabs_data['card_brand'],
            'card_first_six_digits' => $payTabs_data['card_first_six_digits'],
            'card_last_four_digits' => $payTabs_data['card_last_four_digits'],
            'response_code' => $payTabs_data['response_code'],
            'model_type' => $model_type,
            'model_id' => $model_id,
            'payment_type' => Transaction::PAYMENT_TYPE_CREDIT,
            'reservation_id' => $reservation->id,
            'doctor_id' => $reservation->doctor_id,
        ];

        return $this->updateOrCreate(
            collect($attributes)->only('model_type', 'model_id', 'reservation_id', 'doctor_id', 'payment_type')->toArray()
            , $attributes);
    }
}
