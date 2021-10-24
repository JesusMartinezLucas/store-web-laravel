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
        $categories = Category::latest()->get();
        return view('products.create', compact('categories'));
    } 

    public function store(Request $request)
    {

        $this->validate($request, [
            'category' => 'required|exists:categories,id',
            'price' => 'required|numeric|between:0,999.99',
            'description' => 'required|max:1024',
            'barcode' => 'max:255|unique:products,barcode',
            'image' => 'image|nullable|max:1999'
        ]);

        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/image', $fileNameToStore);
        }
        else {
            $fileNameToStore = 'noImage.jpeg';
        }

        Category::find($request->category)
            ->products()
            ->create([
                'price' => $request->price,
                'description' => $request->description,
                'barcode' => $request->barcode,
                'image' => $fileNameToStore
            ]);

            return redirect()->route('products.index');
    }

    public function destroy(Product $product){
        $product->delete();

        return back();
    }
}
