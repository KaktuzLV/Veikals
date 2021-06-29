<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizesController extends Controller
{
    public function index()
    {
        $sizes = Size::all();
        return view('admin.sizes.index', [
            'sizes' => $sizes
        ]);
    }

    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        Size::create($data);

        return redirect()->route('admin.sizes.index');
    }

    public function edit(Size $size)
    {
        return view('admin.sizes.edit', [
            'size' => $size
        ]);
    }

    public function update(Request $request, Size $size)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        $size->update($data);

        return redirect()->route('admin.sizes.index');
    }

    public function destroy(Size $size)
    {
        $size->delete();

        return redirect()->route('admin.sizes.index');
    }
}
