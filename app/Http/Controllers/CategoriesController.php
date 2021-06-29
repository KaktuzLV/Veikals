<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Manufacturer;
use App\Models\Size;
use Illuminate\Database\Eloquent\Builder;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
        $manufacturers = Manufacturer::all();
        $colors = Color::all();
        $sizes = Size::all();

        $activeFilters = [
            'manufacturers' => [],
            'colors' => [],
            'sizes' => [],
        ];

        $products = $category->products();
        if (!empty(request()->get('manufacturers'))) {
            $activeFilters['manufacturers'] = request()->get('manufacturers');
            $products = $products->whereIn('manufacturer_id', $activeFilters['manufacturers']);
        }
        if (!empty(request()->get('colors'))) {
            $activeFilters['colors'] = request()->get('colors');
            $products = $products->whereHas('colors', function (Builder $query) {
                $query->whereIn('colors.id', request()->get('colors'));
            });
        }
        if (!empty(request()->get('sizes'))) {
            $activeFilters['sizes'] = request()->get('sizes');
            $products = $products->whereHas('sizes', function (Builder $query) {
                $query->whereIn('sizes.id', request()->get('sizes'));
            });
        }
        $products = $products->paginate(12);

        return view('categories.index', [
            'category' => $category,
            'products' => $products,
            'manufacturers' => $manufacturers,
            'colors' => $colors,
            'sizes' => $sizes,
            'activeFilters' => $activeFilters
        ]);
    }
}
