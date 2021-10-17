<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    public function index(Category $category) 
    {
        $products = $category->products()->with(['category'])->paginate(20);

        return view('categories.products.index', compact(['category', 'products']));
    }
}
