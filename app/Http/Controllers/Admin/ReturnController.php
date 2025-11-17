<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ReturnItem;
use App\Models\ReturnModel;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReturnController extends Controller
{
    public function index()
    {
        $returns = ReturnModel::with('transaction')->orderBy('id', 'DESC')->get();

        return view('admin.returns.index', compact('returns'));
    }

    public function create()
    {
        $transactions = Transaction::with('items.product')->get();

        return view('admin.returns.create', compact('transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required',
            'items' => 'required|array',
        ]);

        $return = ReturnModel::create([
            'return_number' => 'RTN-' . time(),
            'transaction_id' => $request->transaction_id,
            'user_id' => auth()->id(),
        ]);

        $total = 0;

        foreach ($request->items as $item) {
            if ($item['qty'] > 0) {

                $subtotal = $item['qty'] * $item['price'];
                $total += $subtotal;

                ReturnItem::create([
                    'return_id' => $return->id,
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $subtotal,
                ]);

                // Update stok kembali
                Product::where('id', $item['product_id'])
                    ->increment('stock', $item['qty']);
            }
        }

        return redirect()->route('returns.show', $return->id)
            ->with('success', 'Return barang berhasil dibuat.');
    }

    public function show($id)
    {
        $return = ReturnModel::with('transaction.items.product', 'items.product')->findOrFail($id);

        return view('returns.show', compact('return'));
    }

    public function print($id)
    {
        $return = ReturnModel::with('items.product', 'transaction')->findOrFail($id);

        return view('returns.print', compact('return'));
    }
}
