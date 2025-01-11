<?php

namespace App\Http\Controllers;

use App\Models\BkashGateway;
use App\Models\BkashTransction;
use App\Models\Invoice;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\SMSController;

class BkashController extends Controller
{
    public function get_auth_token(){
        // Fetch the token record from the database
        $gateways = BkashGateway::where('active', true)->get();
        if(count($gateways) == 0) return view('web.error.500');
        $gateway = $gateways[0];

        // Check if the token exists and if it has expired (updated_at + 1 hour)
        if (Carbon::parse($gateway->updated_at)->addHour()->isFuture()) {
            // Token is still valid, return with all required data
            return $gateway;
        }

        // UPDATE THE AUTH TOKEN
        $URL = env('BKASH_URL') . '/tokenized/checkout/token/refresh';

        $headers = [
            'Content-Type' => 'application/json',
            'accept' => 'application/json',
            'username' => $gateway->username,
            'password' => $gateway->password
        ];

        $body = [
            'app_key' => $gateway->app_key,
            'app_secret' => $gateway->app_secret_key,
            'refresh_token' => $gateway->refresh_token
        ];

        try{
            $response = Http::withHeaders($headers)->post($URL, $body);
            if($response->successful()){
                $bkash_token = $response->json();
                $update_gateway = [
                    'auth_token' => $bkash_token['id_token'],
                    'refresh_token' => $bkash_token['refresh_token']
                ];
                BkashGateway::where('id', $gateway->id)->update($update_gateway);
                $gateway_upated_data = BkashGateway::findOrFail($gateway->id);
                return $gateway_upated_data;
            }
        }catch(Exception $e){
            return '';
        }
    }

    public function init_bkash_payment($id)
    {
        $invoice = Invoice::findOrFail($id);

        // UPDATE THE AUTH TOKEN
        $URL = env('BKASH_URL') . '/tokenized/checkout/create';

        // PAYMENT GATEWAY DATA
        $gateway = $this->get_auth_token();

        $headers = [
            'Authorization' => $gateway->auth_token,
            'X-APP-Key' => $gateway->app_key,
            'accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $body = [
            'mode' => '0011',
            'payerReference' => strval($invoice->user->phone),
            'callbackURL' => env('APP_URL') . '/bill/bkash/verify',
            'currency' => 'BDT',
            'amount' => $invoice->total,
            'intent' => 'sale',
            'merchantInvoiceNumber' => strval($invoice->id)
        ];

        try{
            $response = Http::withHeaders($headers)->post($URL, $body);
            if($response->successful()){
                $payment_response = $response->json();
                BkashTransction::create([
                    'paymentID' => $payment_response['paymentID'],
                    'bkashURL' => $payment_response['bkashURL'],
                    'amount' => $payment_response['amount'],
                    'merchantInvoiceNumber' => $payment_response['merchantInvoiceNumber']
                ]);
                return redirect($payment_response['bkashURL']);
            }
        }catch(Exception $e){
            dd($e);
        }
    }

    public function verify_bkash_payment(Request $request)
    {
        $payment_id = $request->query('paymentID');
        $status = $request->query('status');

        // SUCCESS PROCESS
        if($status == 'success'){
            $bkash_transaction = BkashTransction::where('paymentID', $payment_id)->first();
            $gateway = BkashGateway::where('active', true)->first();

            // EXECUTE THE PAYMENT
            $headers = [
                'Authorization' => $gateway->auth_token,
                'X-APP-Key' => $gateway->app_key,
                'accept' => 'application/json',
                'Content-Type' => 'application/json'
            ];

            $body = [
                'paymentID' => $payment_id
            ];

            $URL = env('BKASH_URL') . '/tokenized/checkout/execute';

            try{
                $response = Http::withHeaders($headers)->post($URL, $body);
                if($response->successful()){
                    $payment_response = $response->json();
                    if($payment_response['statusCode'] == '0000'){
                        BkashTransction::where('id', $bkash_transaction->id)->update(['verified' => true]);

                        // UPDATE INVOICE INFO
                        $invoice = Invoice::where('id', $bkash_transaction->merchantInvoiceNumber)->first();
                        $invoice->update(['status' => 'paid']);

                        // UPDATE TRANSACTION RECORD
                        Transaction::create([
                            'invoice_id' => $invoice->id,
                            'amount' => $invoice->total,
                            'transaction_id' => $payment_response['trxID'],
                            'payment_method' => $gateway->name
                        ]);

                        // SEND SMS TO CLIENT
                        $sms_service = new SMSController;
                        $invoice_link = env('APP_URL') . '/'.'bill/' . $invoice->id;
                        $message = 'Dear '. $invoice->user->name .',\nWe got your payment for invoice ID-' . $invoice->id . ' total of '. $invoice->total . ' TAKA.\nYour invoice has been marked as paid.\nSee invoice: ' . $invoice_link . '\n\nThank you!\nDL Soft.';
                        $sms_service->send_sms($invoice->user->phone, $message);
                        return redirect()->route('bill.view', $invoice->id);
                    }else{
                        dd($payment_response);
                        return $payment_response['statusCode'];
                    }
                }else{
                    dd('http request errro');
                    return view('web.error.500');
                }
            }catch(Exception $e){
                dd($e);
                return view('web.error.500');
            }
        }else if($status == 'failure') {
            $bkash_transaction = BkashTransction::where('paymentID', $payment_id)->first();
            return view('web.error.payment-failed', compact('bkash_transaction'));
        }
    }
}
