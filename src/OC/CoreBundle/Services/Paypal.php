<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 25/05/16
 * Time: 11:15
 */

namespace OC\CoreBundle\Services;


class Paypal
{
    private $user = "tabodino-seller_api1.gmail.com";
    private $pwd = "H7M84G5CEQNNFBER";
    private $signature = "AFcWxV21C7fd0v3bYYYRCpSSRl31AO9MoDI.K253DLlZfI0Wttf7HB-j";
    private $endpoint = "https://api-3t.sandbox.paypal.com/nvp";
    public $errors = array();

    public function __construct($user = false, $pwd = false, $signature = false, $prod = false)
    {
        if ($user) $this->user = $user;
        if ($pwd) $this->pwd = $pwd;
        if ($signature) $this->signature = $signature;
        if ($prod) $this->endpoint = str_replace('sandbox.','' , $this->endpoint);
    }

    public function request($method, $params)
    {
        // Paramètres à réutiliser à chaque requete
        $params = array_merge($params, array(
            'METHOD' => $method,
            'USER' => $this->user,
            'PWD' => $this->pwd,
            'SIGNATURE' => $this->signature,
            'VERSION' => 93,
            'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE',
            'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR'
        ));
        // Converti le tableau en chaine de caractères
        $params = http_build_query($params);

        // Appel de l'API en curl
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->endpoint,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS =>$params,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_VERBOSE => 1,

        ));

        $response = curl_exec($curl);
        $responseArray = array();
        parse_str($response, $responseArray);


        if (curl_errno($curl)) {
            $this->errors = curl_error($curl);
            curl_close($curl);
            return false;

        }else{
            if ($responseArray['ACK'] === 'Success') {
                curl_close($curl);
                return $responseArray;
            }else {
                $this->errors = $responseArray;
                curl_close($curl);

                return false;
            }

        }

        die('https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$responseArray['TOKEN']);
    }
}