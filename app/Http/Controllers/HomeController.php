<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $products = Product::orderBy('created_at')->take(8)->get();

        return view('home.index', ['products' => $products]);
    }

    public function search(Request $request){
        $search = $request->search;

        $products = Product::where('title', 'LIKE', "%{$search}%")->get();

        return view('home.search', ['products' => $products]);
    }
}
