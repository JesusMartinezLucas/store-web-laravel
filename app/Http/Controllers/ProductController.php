<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(['index', 'show']);
    }

    public function index()
    {
        $products = Product::latest()->with('category')->paginate(20);

        return view('products.index', compact('products'));

    }

    public function show(Product $product)
    {
      return view('products.show', compact('product'));
    }

    public function create()
    {
        return view('products.create');
    } 

    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        Category::where('id', $request->category)
            ->first()
            ->products()
            ->create($request->only('price', 'description'));

            return redirect()->route('products.index');
    }

    public function destroy(Product $product){
        $product->delete();

        return back();
    }
}
