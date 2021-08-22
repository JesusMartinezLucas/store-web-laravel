<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    public function index(Category $category) 
    {
        $products = $category->products()->with(['category', 'sales'])->paginate(20);

        return view('categories.products.index', [
            'category' => $category,
            'products' => $products,
        ]);
    }
}
