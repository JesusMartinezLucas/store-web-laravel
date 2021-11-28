<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('home');
    }

    public function search(Request $request){

        $search = $request->input('search');

        if(is_null($search)) {
            return response()->json(['products' => []]);
        }

        $products = Product::query()
            ->where('description', 'LIKE', "%{$search}%")
            ->orWhere('barcode', 'LIKE', "%{$search}%")
            ->latest()->get();
    
        return response()->json(compact('products'));
    }
}
