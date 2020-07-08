<?php


namespace App\Services\Contracts;


use App\Models\Patient;

interface TransactionContract
{

    /**
     * @param Patient $patient
     * @param $price
     * @param $reference_no
     * @param string|null $redirect_link
     * @param int $other_charges
     * @param int $discount
     * @param string $product_name
     * @return array
     */
    public function Checkout(Patient $patient, $price, $reference_no, ?string $redirect_link=null, $other_charges = 0, $discount = 0, $product_name = "Call"): array;

    public function verify($reference_code): array;
}
