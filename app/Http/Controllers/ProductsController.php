<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductsController extends Controller
{
    /**
     * Adds new product to the database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $show = Product::all();

        return ($show);
    }

    public function show(Product $products)
    {
        $objproducts = Product::where('product', $products)->get();

        return $objproducts;
    }

    public function store(Request $request) {

        if ($request->validate([
            'title' => 'required|max:191',
            'desc' => 'required|max:1000',
            'price' => 'required',
        ]))

        {
            $objproduct = new Product();
            $objproduct->title = $request->input('title');
            $objproduct->desc = $request->input('desc');
            $objproduct->instock = $request->input('instock');
            $objproduct->price = $request->input('price');
            $objproduct->taxes_id = $request->input('tax');
            $objproduct->save();

            return response()->json(['status' => 'succes']);
        } else {
                return response()->json(['status' => 'error']);
            }
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $products)
    {
        Product::edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $products)
    {
        //
    }

}
