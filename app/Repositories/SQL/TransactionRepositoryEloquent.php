<?php

namespace App\Repositories\SQL;

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
     * @param $payTabs_data
     * @return mixed
     */


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

        try {
            ['model_type' => $model_type, 'model_id' => $model_id] = self::decodeOrderId($payTabs_data['order_id']);
        } catch (\Exception $e) {
            throw ValidationException::withMessages(['transaction_id' => __("Wrong Order Id Encoding")]);

        }
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

        return $this->create($attributes);
    }

    /**
     * decode the json of order id
     * @param $payTabs_data
     * @return mixed
     */

    /**
     * decode the json of order id
     * @param $payTabs_data
     * @return mixed
     */
    public static function decodeOrderId($order_id)
    {
        return json_decode(str_replace('\\', '', $order_id), true);
    }
}
