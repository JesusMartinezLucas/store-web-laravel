<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Mail\SaleReturned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $this->authorize('deleteLastSale', $product);

        $request->user()->sales()->where('product_id', $product->id)->orderBy('id', 'desc')->first()->delete();

        $product->quantity += 1;
        $product->update(); 

        Mail::to(auth()->user())->send(new SaleReturned($product));

        return back();
    }
}
