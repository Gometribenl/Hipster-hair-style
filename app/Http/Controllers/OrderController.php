<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Support\Facades\Auth;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OrderController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * handles perparing for a payment where $value = shopping cart, redirect url is for accesing the api in localhost via Ngrok
     */
    public function preparePayment(Request $request)
    {
        $value = strval($request->value);
        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $value // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            "description" => "Order #12345",
            "redirectUrl" => 'http://a89ca10556f8.ngrok.io/order/success',
            //YOU HAVE TO CHANGE THIS EVERY TIME YOU START NGROK
            "webhookUrl" => 'http://a89ca10556f8.ngrok.io/order/webhooks',
            "metadata" => [
                "order_id" => "12345",
            ],
        ]);
        session_start();

        $_SESSION['payment_id'] = $payment->id;
        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    /**
     * @return string
     * handles the orders if success order gets added to the database else payment failed
     *
     */

    public function handleErrorOrSuccess()
    {

        session_start();

        $payment = Mollie::api()->payments->get($_SESSION['payment_id']);


        if ($payment->isPaid()) {
            // saves order in database when paid for
            $objOrder = new Order();
            $objOrder->user_id = Auth::id();
            $objOrder->date = now();
            $objOrder->save();

            return 'Payment received.';


        }

        return 'Payment failed!!!';

    }


}
