<?php
namespace MyketValidator;

class Validator {
    private $packageName;
    private $token;

    /**
     * Constructor
     *
     * @param  string $packageName  Your App's Package Name
     * @param  string $token        Your Myket Account API-KEY
     * @return void
     */
    public function __construct($packageName, $token) {
        $this->packageName = $packageName;
        $this->token = $token;
    }

    /**
     * validate user's payment
     *
     * @param  string $sku                  Product That User Has Bought
     * @param  string $payment_token        Payment Token
     * @return object Payment Verification Result
     */
    public function validate($sku, $payment_token) {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://developer.myket.ir/api/applications/' . $this->packageName . '/purchases/products/' . $sku . '/tokens/' . $payment_token,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => [
                    'X-Access-Token: ' . $this->token,
                ],
            ]);

            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $response = curl_exec($curl);

            curl_close($curl);

            $response = json_decode($response, true);

            return [
                'status' => $httpcode,
                'data' => $response,
            ];
        } catch (\Throwable $th) {
            throw new \Exception("Can't validate Myket Token");
        }
    }
}
