<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('categories.index');
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
}
