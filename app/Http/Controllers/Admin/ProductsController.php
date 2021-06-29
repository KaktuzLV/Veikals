<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $manufacturers = Manufacturer::all();

        return view('admin.products.create', [
            'categories' => $categories,
            'colors' => $colors,
            'sizes' => $sizes,
            'manufacturers' => $manufacturers
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:2',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'color_ids' => 'array|required|exists:colors,id',
            'size_ids' => 'array|required|exists:sizes,id',
            'price' => 'required|numeric|between:0,99999.99'
        ]);

        $product = Product::create($data);
        $product->colors()->sync($data['color_ids']);
        $product->sizes()->sync($data['size_ids']);

        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $manufacturers = Manufacturer::all();

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories,
            'colors' => $colors,
            'sizes' => $sizes,
            'manufacturers' => $manufacturers
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|min:2',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'color_ids' => 'array|required|exists:colors,id',
            'size_ids' => 'array|required|exists:sizes,id',
            'price' => 'required|numeric|between:0,99999.99'
        ]);

        $product->update($data);
        $product->colors()->sync($data['color_ids']);
        $product->sizes()->sync($data['size_ids']);

        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index');
    }
}
