<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $units = Unit::when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('admin.units.index', compact('units'));
    }

    public function create()
    {
        return view('admin.units.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Unit::create($request->all());

        return redirect()->route('units.index')->with('success', 'Unit berhasil ditambahkan');
    }

    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('admin.units.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $unit = Unit::findOrFail($id);
        $unit->update($request->all());

        return redirect()->route('units.index')->with('success', 'Unit berhasil diperbarui');
    }

    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();

        return redirect()->route('units.index')->with('success', 'Unit berhasil dihapus');
    }
}
