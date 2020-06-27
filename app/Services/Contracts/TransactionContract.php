<?php


namespace App\Services\Contracts;


use App\Models\Patient;

interface TransactionContract
{

    public function Checkout(Patient $patient, $price,array $reference_no = [], $other_charges = 0, $discount = 0, $product_name = "Call"): array;

    public function verify($reference_code): array;
}
