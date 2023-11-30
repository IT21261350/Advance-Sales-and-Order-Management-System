<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function pView() {
        $products = Product::all();
        return view('products.pView', ['products' => $products]);
        //return view('products.pView');
    }

    public function ProductRegistration() {
        return view('products.ProductRegistration');
    }

    public function store(Request $request) {
        //dd( $request );
        $data = $request->validate([
            'proName' => 'required',
            'proCode' => 'required',
            'price' => 'required|numeric',
            'exDate' => 'required|date'
        ]);
    
        $newProduct = Product::create($data);
    
        return redirect(route('product.pView'));
    }

    public function edit(Product $product) {
        //dd($customer);
        return view('products.pEdit', ['product' => $product]);
    }

    public function update(Product $product, Request $request ) {
        $data = $request->validate([
            'proName' => 'required',
            'proCode' => 'required',
            'price' => 'required|numeric',
            'exDate' => 'required|date'
        ]);

        $product -> update($data);

        return redirect(route('product.pView'))->with('success', 'Product Updated Successfully');

    }

    public function delete(Product $product) {
        $product -> delete();
        return redirect(route('product.pView'))->with('success', 'Product Deleted Successfully');
    }

}
