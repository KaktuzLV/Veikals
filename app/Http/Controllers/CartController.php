<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [];
        }

        if (empty($cart)) {
            return redirect()->route('home');
        }

        $cart = collect($cart);

        $products = Product::with(['colors', 'sizes'])->whereIn('id', $cart->pluck('product_id')->unique()->toArray())->get();

        $cart = $cart->map(function($item) use($products) {
            $item['product'] = $products->where('id', $item['product_id'])->first();
            $item['color'] = $item['product']->colors->where('id', $item['color_id'])->first();
            $item['size'] = $item['product']->sizes->where('id', $item['size_id'])->first();
            return $item;
        });

        $cartAmount = $cart->reduce(function($carry, $item) {
            return $carry + $item['product']->price * $item['quantity'];
        });

        return view('cart.index', [
            'products' => $products,
            'cart' => $cart,
            'cartAmount' => $cartAmount
        ]);
    }

    public function add(Request $request, Product $product) {
        $data = $request->validate([
            'color_id' => 'required|in:' . $product->colors()->pluck('colors.id')->join(','),
            'size_id' => 'required|in:' . $product->sizes()->pluck('sizes.id')->join(',')
        ]);

        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [];
        }

        $productKey = implode('-', [
            $product->id,
            $data['color_id'],
            $data['size_id']
        ]);

        if (isset($cart[$productKey])) {
            $cart[$productKey]['quantity']++;
        } else {
            $cart[$productKey] = [
                'product_id' => $product->id,
                'color_id' => $data['color_id'],
                'size_id' => $data['size_id'],
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }

    public function remove(Request $request, Product $product) {
        $data = $request->validate([
            'color_id' => 'required|in:' . $product->colors()->pluck('colors.id')->join(','),
            'size_id' => 'required|in:' . $product->sizes()->pluck('sizes.id')->join(',')
        ]);

        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [];
        }

        $productKey = implode('-', [
            $product->id,
            $data['color_id'],
            $data['size_id']
        ]);

        if (!isset($cart[$productKey])) {
            return redirect()->route('cart.index');
        }
        $cart[$productKey]['quantity']--;

        if ($cart[$productKey]['quantity'] <= 0) {
            unset($cart[$productKey]);
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }
}
