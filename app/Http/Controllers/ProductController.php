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

        $paginate = 16;
        $products = Product::where('category_id', $category->id)->paginate($paginate);

        if (isset($request->orderBy)) {
            if ($request->orderBy == 'price-low-high'){
                $products = Product::where('category_id', $category->id)->orderBy('price')->paginate($paginate);
            }
            if ($request->orderBy == 'price-high-low'){
                $products = Product::where('category_id', $category->id)->orderBy('price', 'desc')->paginate($paginate);
            }
            if ($request->orderBy == 'name-a-z'){
                $products = Product::where('category_id', $category->id)->orderBy('title')->paginate($paginate);
            }
            if ($request->orderBy == 'name-z-a'){
                $products = Product::where('category_id', $category->id)->orderBy('price', 'desc')->paginate($paginate);
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
