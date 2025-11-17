<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('supplier', 'user')->latest()->paginate(10);
        return view('admin.purchases.index', compact('purchases'));
    }

    public function create()
    {
        return view('admin.purchases.create', [
            'suppliers' => Supplier::all(),
            'products'  => Product::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'items'       => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty'   => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric|min:1',
            'payment_method' => 'required|in:cash,transfer,credit'
        ]);

        DB::beginTransaction();

        try {
            $paymentStatus = $request->payment_method === 'credit' ? 'unpaid' : 'paid';

            $invoice = 'INV-' . date('Ymd') . '-' . rand(1000, 9999);

            // Hitung total
            $total = collect($request->items)->sum(function($item){
                return $item['qty'] * $item['price'];
            });

            // Insert header pembelian
            $purchase = Purchase::create([
                'supplier_id'    => $request->supplier_id,
                'invoice_number' => $invoice,
                'payment_method' => $request->payment_method,
                'payment_status' => $paymentStatus,
                'total'          => $total,
                'user_id'        => auth()->id(),
            ]);

            // Insert detail item
            foreach ($request->items as $item) {
                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id'  => $item['product_id'],
                    'qty'         => $item['qty'],
                    'price'       => $item['price'],
                    'subtotal'    => $item['qty'] * $item['price'],
                ]);

                // Update stok
                Product::where('id', $item['product_id'])
                    ->increment('stock', $item['qty']);
            }

            DB::commit();
            return redirect()
                ->route('purchases.index')
                ->with('success', 'Pembelian berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $purchase = Purchase::with('supplier', 'items.product', 'user')
                            ->findOrFail($id);

        return view('admin.purchases.show', compact('purchase'));
    }

    public function print($id)
{
    $purchase = Purchase::with('supplier', 'items.product', 'user')->findOrFail($id);

    return view('admin.purchases.print', compact('purchase'));
}

}
