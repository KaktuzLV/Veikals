<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::paginate(16);

        return view('products.index', [
            'products' => $products
        ]);
    }

    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product
        ]);
    }
}
