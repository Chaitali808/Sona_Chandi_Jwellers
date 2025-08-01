<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/razorpay/Razorpay.php';

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Razorpay_lib
{
    private $api;

    public function __construct()
    {
        // $key_id = 'rzp_test_cFYTpLVvrC4FFn';
        // $secret_key = 'LHymgUT3qIDnvvNoCUG2mN8L';

        //  $key_id = 'rzp_test_n9TyNiHflMp51H';
        // $secret_key = '2tR5N1R426SIVqvyEAfOzJze';


        // $key_id = 'rzp_live_aKnqCVUpRcVAoS';
        // $secret_key = 'IMsHCTErcyGDCfLK312TEkfW';



        //Jyotisika update keys

         $key_id = 'rzp_test_YcEtdZa9f7N8R6';
        $secret_key = 'A9amaWCSAUc98Payc0qFml23';

        
         //Jyotisika updated live keys

        //   $key_id = 'rzp_live_OhYeV3XCMIFBH5';
        // $secret_key = '0qBqV0NMUQHtkVT8AthE9959';

        $this->api = new Api($key_id, $secret_key);
    }

    // Create a Razorpay Order
    public function create_order($amount, $receipt)
    {
        try {
            return $this->api->order->create([
                'receipt' => $receipt,
                'amount' => $amount * 100, // Convert to paisa
                'currency' => 'INR',
                'payment_capture' => 1
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    // Verify Payment Signature
    // public function verify_payment($payment_id, $order_id, $signature) {
    //     try {
    //         $key_secret = 'LHymgUT3qIDnvvNoCUG2mN8L'; // Use your Razorpay Secret Key
    //         $generated_signature = hash_hmac('sha256', $order_id . "|" . $payment_id, $key_secret);
    //         return $generated_signature === $signature;
    //     } catch (Exception $e) {
    //         return false;
    //     }
    // }

    public function verify_payment($payment_id, $order_id, $signature)
    {
        try {
            // $key_secret = 'LHymgUT3qIDnvvNoCUG2mN8L';
            $key_secret = 'A9amaWCSAUc98Payc0qFml23';


            //Secrete key 
            // $key_secret = '0qBqV0NMUQHtkVT8AthE9959';


            
            

            // $key_secret = 'IMsHCTErcyGDCfLK312TEkfW';
            
            $generated_signature = hash_hmac('sha256', $order_id . "|" . $payment_id, $key_secret);
            return $generated_signature === $signature;
        } catch (Exception $e) {
            return false;
        }
    }
}
