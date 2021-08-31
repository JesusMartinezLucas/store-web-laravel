<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index()
    {
        $products = Product::latest()->with('category', 'sales')->paginate(20);

        return view('products.index', [
            'products' => $products
        ]);

    }

    public function show(Product $product)
    {
      return view('products.show', [
          'product' => $product
      ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => 'required',
            'price' => 'required',
            'description' => 'required',
            'quantity' => 'required',
        ]);

        Category::where('id', $request->category)
            ->first()
            ->products()
            ->create($request->only('price', 'description', 'quantity'));

        return back();
    }

    public function destroy(Product $product){
        $product->delete();

        return back();
    }
}
