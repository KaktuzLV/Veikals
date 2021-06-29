<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturersController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::all();
        return view('admin.manufacturers.index', [
            'manufacturers' => $manufacturers
        ]);
    }

    public function create()
    {
        return view('admin.manufacturers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        Manufacturer::create($data);

        return redirect()->route('admin.manufacturers.index');
    }

    public function edit(Manufacturer $manufacturer)
    {
        return view('admin.manufacturers.edit', [
            'manufacturer' => $manufacturer
        ]);
    }

    public function update(Request $request, Manufacturer $manufacturer)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        $manufacturer->update($data);

        return redirect()->route('admin.manufacturers.index');
    }

    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();

        return redirect()->route('admin.manufacturers.index');
    }
}
