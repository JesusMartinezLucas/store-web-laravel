<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(['index', 'search']);
    }

    public function index()
    {
        $products = Product::latest()->with('category')->paginate(12);

        return view('products.index', compact('products'));

    }

    public function search(Request $request){

        $this->validate($request, [
            'search' => 'max:1024',
        ]);

        $search = $request->input('search');

        $products = Product::query()
            ->where('description', 'LIKE', "%{$search}%")
            ->orWhere('barcode', 'LIKE', "%{$search}%")
            ->latest()
            ->with('category')
            ->paginate(12)
            ->withQueryString();
    
        return view('products.index', compact('products', 'search'));
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
            'barcode' => 'max:255|nullable|unique:products,barcode',
            'image' => 'image|nullable|max:9999'
        ]);

        $fileNameToStore = NULL;
        if ($request->hasFile('image')) {
            $fileNameToStore = self::storeImage($request->file('image'));
        }

        $product = Category::find($request->category)
            ->products()
            ->create([
                'price' => $request->price,
                'description' => $request->description,
                'barcode' => $request->barcode,
                'image' => $fileNameToStore
            ]);

        return redirect()->route('products.index');
    }

    public function edit(Product $product){

        $categories = Category::latest()->get();
        return view('products.edit', compact('product', 'categories'));

    }

    public function update(Request $request, Product $product){

        $this->validate($request, [
            'category' => 'required|exists:categories,id',
            'price' => 'required|numeric|between:0,999.99',
            'description' => 'required|max:1024',
            'barcode' => [
                'max:255', 'nullable',
                Rule::unique('products', 'barcode')->ignore($product)
            ],
            'image' => 'image|nullable|max:9999'
        ]);

        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->barcode = $request->barcode;

        if ($request->hasFile('image')) {
            if (!is_null($product->image)) {
                self::deleteImage($product->image);
            }

            $product->image = self::storeImage($request->file('image'));
        }
        
        $product->save();
        return back()->with('status', 'El producto se actualizó correctamente');

    }

    private static function storeImage($image){
        $filenameWithExt = $image->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        $image->storeAs('public/image', $fileNameToStore);

        return $fileNameToStore;
    }

    private static function deleteImage($image){
        $filePathToDelete = public_path("/storage/image/$image");
        
        if (File::exists($filePathToDelete)) {
            File::delete($filePathToDelete);
        }
    }

    public function destroy(Product $product){
        if (!is_null($product->image)) {
            self::deleteImage($product->image);
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}
