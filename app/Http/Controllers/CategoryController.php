<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['admin'])->only('destroy');
    }

    public function index()
    {
        $categories = Category::latest()->paginate(20);
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
}
