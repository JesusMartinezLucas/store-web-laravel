<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['productsIndex', 'productsSearch']);
        $this->middleware(['admin'])->only('destroy');
    }

    public function index()
    {
        $categories = Category::latest()->paginate(12);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required|max:255|unique:categories,name',
        ]);

        Category::create($request->only('name'));

        return redirect()->route('categories.index');

    }

    public function destroy(Category $category){
        $category->delete();

        return back();
    }

    public function productsIndex(Category $category)
    {
        $products = $category->products()->latest()->with('category')->paginate(12);

        return view('categories.products.index', compact('category', 'products'));
    }

    public function productsSearch(Request $request, Category $category){

        $this->validate($request, [
            'search' => 'max:1024',
        ]);

        $search = $request->input('search');

        $products = $category->products()
            ->where(function($query) use ($search) {
                $query->where('description', 'LIKE', "%{$search}%")
                      ->orWhere('barcode', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->with('category')
            ->paginate(12)
            ->withQueryString();
    
        return view('categories.products.index', compact('category', 'products', 'search'));
    }
}
