<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Adds new product to the database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $objproduct = new Product();
        $objproduct->title = $request->input('title');
        $objproduct->desc = $request->input('desc');
        $objproduct->instock = $request->input('instock');
        $objproduct->price = $request->input('price');
        $objproduct->taxes_id = $request->input('tax');
        $objproduct->save();

        return $this->index();
    }

}
