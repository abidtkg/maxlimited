<?php

namespace App\Http\Controllers;

use App\Models\BkashGateway;
use App\Models\BkashTransaction;
use App\Models\BkashTransction;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderTransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class BkashController extends Controller
{
    public function get_auth_token(){
        if (Cache::has('bkash_auth_token')) return Cache::get('bkash_auth_token');
        // UPDATE THE AUTH TOKEN
        $URL = env('BKASH_URL') . '/tokenized/checkout/token/refresh';

        $headers = [
            'Content-Type' => 'application/json',
            'accept' => 'application/json',
            'username' => env('BKASH_USERNAME'),
            'password' =>  env('BKASH_PASSWORD')
        ];

        $body = [
            'app_key' => env('BKASH_APP_KEY'),
            'app_secret' => env('BKASH_APP_SECRET'),
            'refresh_token' => $this->get_refresh_token()
        ];

        try{
            $response = Http::withHeaders($headers)->post($URL, $body);
            if($response->successful()){
                $bkash_token = $response->json();
                $auth_token = $bkash_token['id_token'];
                Cache::put('bkash_auth_token', $auth_token, 30);
            }else {
                return throw new HttpException(500, 'An internal server error occurred.');
            }
        }catch(Exception $e){
            return throw new HttpException(500, 'An internal server error occurred.');
        }
    }

    public function init_bkash_payment($id)
    {
        $order = Order::findOrFail($id);

        // UPDATE THE AUTH TOKEN
        $URL = env('BKASH_URL') . '/tokenized/checkout/create';

        $headers = [
            'Authorization' => $this->get_auth_token(),
            'X-APP-Key' => env('BKASH_APP_KEY'),
            'accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $total_payment = round($order->payable + ($order->payable * 0.01), 2);

        $body = [
            'mode' => '0011',
            'payerReference' => strval($order->user->phone),
            'callbackURL' => env('APP_URL') . '/bkash/verify',
            'currency' => 'BDT',
            'amount' => $total_payment,
            'intent' => 'sale',
            'merchantInvoiceNumber' => strval($order->id)
        ];

        try{
            $response = Http::withHeaders($headers)->post($URL, $body);
            if($response->successful()){
                $payment_response = $response->json();
                // return $payment_response;
                BkashTransaction::create([
                    'order_id' => $order->id,
                    'paymentID' => $payment_response['paymentID'],
                    'bkashURL' => $payment_response['bkashURL'],
                    'amount' => $payment_response['amount'],
                    'merchantInvoiceNumber' => $payment_response['merchantInvoiceNumber']
                ]);
                return redirect($payment_response['bkashURL']);
            }
        }catch(Exception $e){
            dd($e);
            return throw new HttpException(500, 'An internal server error occurred.');
        }
    }

    public function verify_bkash_payment(Request $request)
    {
        $paymentID = $request->query('paymentID');
        $status = $request->query('status');

        // SUCCESS PROCESS
        if($status == 'success'){
            $bkash_transaction = BkashTransaction::where('paymentID', $paymentID)->first();

            // EXECUTE THE PAYMENT
            $headers = [
                'Authorization' => $this->get_auth_token(),
                'X-APP-Key' => env('BKASH_APP_KEY'),
                'accept' => 'application/json',
                'Content-Type' => 'application/json'
            ];


            $body = [
                'paymentID' => $paymentID
            ];

            $URL = env('BKASH_URL') . '/tokenized/checkout/execute';

            $response = Http::withHeaders($headers)->post($URL, $body);
            if($response->successful() == false) {
                return $response;
            }
            
            try{
                $payment_response = $response->json();
                if($payment_response['statusCode'] == '0000'){
                    // UPDATE INVOICE INFO
                    $order = Order::findOrFail($bkash_transaction->order_id);
                    $order->update([
                        'due' => 0,
                    ]);


                    // UPDATE TRANSACTION RECORD
                    OrderTransaction::create([
                        'order_id' => $order->id,
                        'gateway' => 'bkash_online',
                        'transaction_id' => $payment_response['trxID'],
                        'amount' => $order->payable,
                        'verified' => true
                    ]);

                    return redirect()->route('client.order.view', $order->id);
                }else{
                    throw new HttpException(500, 'Payment process failed, try again!');
                }
            }catch(Exception $e){
                throw new HttpException(500, 'Payment process failed, try again!');
            }
        }else if($status == 'failure') {
            throw new HttpException(500, 'Payment process failed, try again!');
        }
    }


    public function get_refresh_token()
    {
        if (Cache::has('bkash_refresh_token')) return Cache::get('bkash_refresh_token');
        // UPDATE THE REFRESH TOKEN
        $URL = env('BKASH_URL') . '/tokenized/checkout/token/grant';

        $headers = [
            'Content-Type' => 'application/json',
            'accept' => 'application/json',
            'username' => env('BKASH_USERNAME'),
            'password' => env('BKASH_PASSWORD')
        ];

        $body = [
            'app_key' => env('BKASH_APP_KEY'),
            'app_secret' => env('BKASH_APP_SECRET')
        ];

        try{
            $response = Http::withHeaders($headers)->post($URL, $body);
            if($response->successful()){
                $bkash_token = $response->json();
                Cache::put('bkash_refresh_token', $bkash_token['refresh_token'], now()->addDays(20));
                return $bkash_token['refresh_token'];
                // $update_gateway = [
                //     'auth_token' => $bkash_token['id_token'],
                //     'refresh_token' => $bkash_token['refresh_token'],
                //     'active' => true
                // ];
            }else{
                throw new HttpException(500, 'An internal server error occurred.');
            }
        }catch(Exception $e){
            throw new HttpException(500, 'An internal server error occurred.');
        }
    }
}
