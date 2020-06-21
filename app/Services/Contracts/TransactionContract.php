<?php


namespace App\Services\Contracts;


use App\Models\Patient;

interface TransactionContract
{

    public function Checkout(Patient $patient, $price, $reference_no = 1231231, $other_charges = 0, $discount = 0, $product_name = "Call"): array;

    public function verify($reference_code): array;
}
