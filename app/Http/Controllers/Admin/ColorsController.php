<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorsController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('admin.colors.index', [
            'colors' => $colors
        ]);
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        Color::create($data);

        return redirect()->route('admin.colors.index');
    }

    public function edit(Color $color)
    {
        return view('admin.colors.edit', [
            'color' => $color
        ]);
    }

    public function update(Request $request, Color $color)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        $color->update($data);

        return redirect()->route('admin.colors.index');
    }

    public function destroy(Color $color)
    {
        $color->delete();

        return redirect()->route('admin.colors.index');
    }
}
