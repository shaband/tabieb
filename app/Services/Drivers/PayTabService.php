<?php


namespace App\Services\Drivers;

use App\Services\paytabs\PayTabsFacade;
use App\Models\Patient;

class PayTabService implements \App\Services\Contracts\TransactionContract
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
    public function Checkout(Patient $patient, $price, $reference_no, ?string $redirect_link = null, $other_charges = 0, $discount = 0, $product_name = "Call"): array
    {

        $result = PayTabsFacade::authentication();

        $result = PayTabsFacade::create_pay_page(array(

            'cc_first_name' => $patient->first_name,          //This will be prefilled as Credit Card First Name
            'cc_last_name' => $patient->last_name,            //This will be prefilled as Credit Card Last Name
            'cc_phone_number' => $patient->phone ?? "00973",
            'phone_number' => $patient->phone ?? "33333333",
            'email' => $patient->email,
            'billing_address' => "manama bahrain",
            'city' => "manama",
            'state' => "manama",
            'postal_code' => "00973",
            'country' => "BHR",
            'address_shipping' => "Juffair bahrain",
            'city_shipping' => "manama",
            'state_shipping' => "manama",
            'postal_code_shipping' => "00973",
            'country_shipping' => "BHR",
            "products_per_title" => $product_name ?? "Product1",
            'quantity' => "1",
            'unit_price' => (string)$price,
            "other_charges" => (string)$other_charges,
            'amount' => (string)$price,
            'discount' => (string)$discount,
            'currency' => "SAR",
            'title' => $patient->username, "msg_lang" => app()->getLocale(),
            "reference_no" => $reference_no,
            "cms_with_version" => "API USING PHP",
            "site_url" => config('services.paytabs.site_url'),
            'return_url' => $redirect_link ?: config('services.paytabs.redirect'),
            "paypage_info" => "1"
        ));

        return $result;
    }

    public function verify($reference_code): array
    {
        return PayTabsFacade::verify_payment($reference_code);
    }

    public function verify_transaction($transaction_id): array
    {
        return PayTabsFacade::verify_transaction($transaction_id);
    }
}
