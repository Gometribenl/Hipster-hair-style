<?php

namespace App\Http\Controllers;

use Mollie\Laravel\Facades\Mollie;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function preparePayment(Request $request)
    {
        $value= strval($request->value);
        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $value // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            "description" => "Order #12345",
            "redirectUrl" => 'http://4346e579fbc8.ngrok.io/order/success',
            //YOU HAVE TO CHANGE THIS EVERY TIME YOU START NGROK
            "webhookUrl" => 'http://4346e579fbc8.ngrok.io/order/webhooks',
            "metadata" => [
                "order_id" => "12345",
            ],
        ]);
        session_start();

        $_SESSION['payment_id'] = $payment->id;
        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function handleErrorOrSuccess()
    {

        session_start();

        $payment = Mollie::api()->payments->get($_SESSION['payment_id']);


        if ($payment->isPaid()) {

            return 'Payment received.';


            // Do your thing ...

        }

        return 'Payment failed!!!';

    }
}
