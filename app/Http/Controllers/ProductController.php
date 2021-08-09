<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id) {
        $product = Product::find($id);

        return view('product.show', ['product' => $product]);
    }

    public function showCategory(Request $request, $category) {
        $category = Category::where('alias', $category)->first();

        $products = Product::where('category_id', $category->id)->get();

        if (isset($request->orderBy)) {
            if ($request->orderBy == 'price-low-high'){
                $products = Product::where('category_id', $category->id)->orderBy('price')->get();
            }
            if ($request->orderBy == 'price-high-low'){
                $products = Product::where('category_id', $category->id)->orderBy('price', 'desc')->get();
            }
            if ($request->orderBy == 'name-a-z'){
                $products = Product::where('category_id', $category->id)->orderBy('title')->get();
            }
            if ($request->orderBy == 'name-z-a'){
                $products = Product::where('category_id', $category->id)->orderBy('price', 'desc')->get();
            }
        }

        if ($request->ajax())
            return view('ajax.order-by', [
                'products' => $products
            ])->render();

        return view('categories.index', [
                'category' => $category,
                'products' => $products
        ]);
    }
}
