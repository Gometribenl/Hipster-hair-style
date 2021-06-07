<?php

namespace App\Http\Controllers;

use App\Tax;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TaxController extends Controller
{

    /**
     * Store a new tax you can add to a product
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $objtax = new Tax();
        $objtax->tax = $request->input('tax');
        $objtax->save();
    }

}
