<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Size;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

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
            'price' => 'required|numeric|between:0,99999.99',
            'image' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        $image = $data['image'] ?? null;
        unset($data['image']);

        $product = Product::create($data);
        $product->colors()->sync($data['color_ids']);
        $product->sizes()->sync($data['size_ids']);

        $image = Image::make($image)->resize(500, 500)->encode('jpg');
        $filename = $product->id . '.jpg';
        Storage::put(implode(DIRECTORY_SEPARATOR, [
            'public',
            'products',
            $filename
        ]), $image->__toString());

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
            'price' => 'required|numeric|between:0,99999.99',
            'image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        /** @var UploadedFile|null $image */
        $image = $data['image'] ?? null;
        unset($data['image']);

        $product->update($data);
        $product->colors()->sync($data['color_ids']);
        $product->sizes()->sync($data['size_ids']);

        if ($image) {
            $image = Image::make($image)->resize(500, 500)->encode('jpg');
            $filename = $product->id . '.jpg';
            Storage::put(implode(DIRECTORY_SEPARATOR, [
                'public',
                'products',
                $filename
            ]), $image->__toString());
        }

        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index');
    }
}
