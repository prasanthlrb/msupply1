<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PayController extends Controller
{

    public function index()
    {
        return view('event');
    }
    //    public function pay(Request $request){

    //      $api = new \Instamojo\Instamojo(
    //             config('services.instamojo.api_key'),
    //             config('services.instamojo.auth_token'),
    //             config('services.instamojo.url')
    //         );

    //     try {
    //         $response = $api->paymentRequestCreate(array(
    //             "purpose" => "FIFA 16",
    //             "amount" => $request->amount,
    //             "buyer_name" => "$request->name",
    //             "send_email" => true,
    //             "email" => "$request->email",
    //             "phone" => "$request->mobile_number",
    //             "redirect_url" => "http://127.0.0.1:8000/pay-success"
    //             ));

    //             header('Location: ' . $response['longurl']);
    //             exit();
    //     }catch (Exception $e) {
    //         print('Error: ' . $e->getMessage());
    //     }
    //  }

    //  public function success(Request $request){
    //      try {

    //         $api = new \Instamojo\Instamojo(
    //             config('services.instamojo.api_key'),
    //             config('services.instamojo.auth_token'),
    //             config('services.instamojo.url')
    //         );

    //         $response = $api->paymentRequestStatus(request('payment_request_id'));

    //         if( !isset($response['payments'][0]['status']) ) {
    //            dd('payment failed');
    //         } else if($response['payments'][0]['status'] != 'Credit') {
    //              dd('payment failed');
    //         }
    //       }catch (\Exception $e) {
    //          dd('payment failed');
    //      }
    //     dd($response);
    //   }
    //rzp_test_InZD6eAnToWcgk
    //1ZeudilDl095it0pbhtzUgA1
    public function payment()
    {
        // $api = new Api("rzp_test_InZD6eAnToWcgk", "1ZeudilDl095it0pbhtzUgA1");
        // $order = $api->order->create(
        //     array(
        //         'receipt' => '123',
        //         'amount' => 100,
        //         'payment_capture' => 1,
        //         'currency' => 'INR'
        //     )
        // );
        // $orderId = $order['id']; // Get the created Order ID
        // $order  = $api->order->fetch($orderId);
        // $displayAmount = $amount = $order['amount'];
        // //$orders = $api->order->all($options); // Returns array of order objects
        // //$payments = $api->order->fetch($orderId)->payments(); // Returns array of payment objects against an order
        // dd($displayAmount);
        // Payments
        //$payments = $api->payment->all($options); // Returns array of payment objects
        // $payment  = $api->payment->fetch($id); // Returns a particular payment
        // $payment  = $api->payment->fetch($id)->capture(array('amount' => $amount)); // Captures a payment
        return view('payment');
    }

    public function razorPaySuccess(Request $request)
    {
        $data = [
            'user_id' => '1',
            'payment_id' => $request->payment_id,
            'amount' => $request->amount,
        ];
        $getId = Payment::insertGetId($data);
        $arr = array('msg' => 'Payment successfully credited', 'status' => true);
        return Response()->json($arr);
    }
    public function RazorThankYou()
    {
        return view('payments.thankyou');
    }
}
