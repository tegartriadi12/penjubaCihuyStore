<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $products = Product::with(['category', 'unit'])
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('barcode', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();
        return view('admin.products.create', compact('categories', 'units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'    => 'required',
            'unit_id'        => 'required',
            'name'           => 'required',
            'purchase_price' => 'required|numeric',
            'selling_price'  => 'required|numeric',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Product berhasil ditambahkan');
    }

    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::all();
        $units      = Unit::all();

        return view('admin.products.edit', compact('product', 'categories', 'units'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id'    => 'required',
            'unit_id'        => 'required',
            'name'           => 'required',
            'purchase_price' => 'required|numeric',
            'selling_price'  => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product berhasil diperbarui');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('products.index')->with('success', 'Product berhasil dihapus');
    }
}
