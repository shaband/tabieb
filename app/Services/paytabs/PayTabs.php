<?php


namespace App\Services\paytabs;


class PayTabs
{
    private $merchant_email;
    private $secret_key;

    const AUTHENTICATION = "https://www.paytabs.com/apiv2/validate_secret_key";
    const PAYPAGE_URL = "https://www.paytabs.com/apiv2/create_pay_page";
    const  VERIFY_URL = "https://www.paytabs.com/apiv2/verify_payment";
    const  VERIFY_Transaction_URL = "https://www.paytabs.com/apiv2/verify_payment_transaction";

    /**
     * PayTabs constructor.
     */
    public function __construct()
    {
        $this->merchant_email = config('services.paytabs.merchant_email');
        $this->secret_key = config('services.paytabs.secret_key');
//        $this->secret_key = $secret_key;

    }

    /*    function paytabs($merchant_email, $secret_key)
        {
            $this->merchant_email = $merchant_email;
            $this->secret_key = $secret_key;
        }*/

    function authentication()
    {


        $response = json_decode($this->runPost(self::AUTHENTICATION, array("merchant_email" => $this->merchant_email, "secret_key" => $this->secret_key)), true);
        if ($response['response_code'] == "4000") {
            return TRUE;
        }
        return FALSE;

    }

    function create_pay_page($values)
    {
        $values['merchant_email'] = $this->merchant_email;
        $values['secret_key'] = $this->secret_key;
        $values['ip_customer'] = $_SERVER['REMOTE_ADDR'];
        $values['ip_merchant'] = $_SERVER['SERVER_ADDR'];
        return json_decode($this->runPost(self::PAYPAGE_URL, $values),TRUE);
    }


    function verify_payment($payment_reference)
    {
        $values['merchant_email'] = $this->merchant_email;
        $values['secret_key'] = $this->secret_key;
        $values['payment_reference'] = $payment_reference;
        return json_decode($this->runPost(self::VERIFY_URL, $values),TRUE);
    }
    function verify_transaction($transaction_id)
    {
        $values['merchant_email'] = $this->merchant_email;
        $values['secret_key'] = $this->secret_key;
        $values['transaction_id'] = $transaction_id;
        return json_decode($this->runPost(self::VERIFY_Transaction_URL, $values),TRUE);
    }

    function runPost($url, $fields): string
    {
        $fields_string = "";
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        $fields_string = rtrim($fields_string, '&');
        $ch = curl_init();
        $ip = $_SERVER['REMOTE_ADDR'];

        $ip_address = array(
            "REMOTE_ADDR" => $ip,
            "HTTP_X_FORWARDED_FOR" => $ip
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        /*
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $ip_address);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, 1);
*/
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

}

