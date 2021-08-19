<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductSaleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Product $product, Request $request)
    {
        if (!$product->inStock()) {
            return response(null, 409);
        }

        $product->sales()->create([
            'user_id' => $request->user()->id,
        ]);

        $product->quantity -= 1;
        $product->update(); 

        return back();
    }

    public function destroy(Product $product, Request $request)
    {
        if (!$product->soldBy($request->user())) {
            return response(null, 409);
        }

        $request->user()->sales()->where('product_id', $product->id)->orderBy('id', 'desc')->first()->delete();
        $product->quantity += 1;
        $product->update(); 

        return back();
    }
}
