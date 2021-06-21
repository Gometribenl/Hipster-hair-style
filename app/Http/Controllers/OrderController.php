<?php

namespace App\Http\Controllers;

use App\Address;
use App\Order;
use App\Order_Quantity;
use App\Product;
use App\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Mollie\Laravel\Facades\Mollie;


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
        //YOU HAVE TO CHANGE THIS EVERY TIME YOU START NGROK
        $url = 'https://hipster.kay-joosten.nl';
//        $value = strval($request->value);
        $order_id = mt_rand(1000000, 9999999);

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $request->total // You must send the correct number of decimals, thus we enforce the use of strings
            ],

            "description" => "hipsterhair ",
            "redirectUrl" => $url . '/order/success',

            "webhookUrl" => $url . '/order/webhooks',
            "metadata" => [
                "order_id" => $order_id,
            ],
        ]);
        session_start();
        $_SESSION['payment_id'] = $payment->id;
        $_SESSION['credentials'] = json_decode($request->credentials);

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
        $products = $_SESSION['credentials']->cart;

        if ($payment->isPaid()) {
            // saves order in database when paid for
            $objOrder = new Order();

            $objOrder->userid = $_SESSION['credentials']->userid;;
            $objOrder->date = now();

            $objOrder->save();

            return 'Payment received.';


        }

        return 'Payment failed!!!';

    }


}
