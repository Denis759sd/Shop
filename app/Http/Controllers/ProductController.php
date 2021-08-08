<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($id) {
        $product = Product::find($id);

        return view('product.show', ['product' => $product]);
    }

    public function showCategory($category) {
        $category = Category::where('alias', $category)->first();

        return view('categories.index', ['category' => $category]);
    }
}
