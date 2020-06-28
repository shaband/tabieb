<?php

namespace App\Repositories\interfaces;

use App\Models\Reservation;
use App\Models\Transaction;
use App\Repositories\interfaces\BaseInterface;
use Illuminate\Validation\ValidationException;

/**
 * Interface TransactionRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface TransactionRepository extends BaseInterface
{
    /**
     * @param $transaction_id
     * @param Reservation $reservation
     * @return Transaction
     * @throws ValidationException
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store($transaction_id,Reservation $reservation):Transaction;

    /**
     * decode the json of order id
     * @param $payTabs_data
     * @return mixed
     */
    public static function decodeOrderId($payTabs_data);
}
