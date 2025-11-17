@extends('layouts.main')

@section('content')
<h2 class="intro-y text-lg font-medium mt-10">Tambah Pembelian</h2>

<div class="grid grid-cols-12 gap-6 mt-5">

    <div class="intro-y col-span-12 lg:col-span-8">

        <div class="box p-5 shadow-md">

            <form action="{{ route('purchases.store') }}" method="POST">
                @csrf

                <!-- SUPPLIER & PAYMENT -->
                <div class="grid grid-cols-12 gap-4">

                    <div class="col-span-12 md:col-span-6">
                        <label class="font-medium text-gray-700">Supplier</label>
                        <select name="supplier_id" class="input border mt-2 w-full" required>
                            <option value="">-- Pilih Supplier --</option>
                            @foreach($suppliers as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="font-medium text-gray-700">Metode Pembayaran</label>
                        <select name="payment_method" class="input border mt-2 w-full">
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                            <option value="credit">Credit</option>
                        </select>
                    </div>

                </div>

                <hr class="my-6">

                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-lg font-medium">Detail Item Pembelian</h3>

                    <button type="button" id="addRow"
                        class="button bg-theme-1 text-white px-4 py-2">
                        + Tambah Item
                    </button>
                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto">
                    <table class="table table-bordered" id="itemTable">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th>Produk</th>
                                <th class="text-center w-24">Qty</th>
                                <th class="text-center w-32">Harga</th>
                                <th class="text-center w-32">Subtotal</th>
                                <th class="text-center w-20">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

                <!-- TOTAL -->
                <div class="mt-5 border-t pt-5 flex justify-end">
                    <div class="text-right">
                        <p class="text-lg font-medium">
                            Total:
                            <span id="grandTotal" class="font-bold text-theme-1">Rp 0</span>
                        </p>
                    </div>
                </div>

                <div class="mt-6 text-right">
                    <button type="submit" class="button bg-theme-1 text-white px-6 py-2">
                        Simpan Pembelian
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

<script>
let rowIndex = 0;

function calculateRow(row) {
    let qty = parseFloat(row.querySelector('.qty').value) || 0;
    let price = parseFloat(row.querySelector('.price').value) || 0;
    let subtotalField = row.querySelector('.subtotal');

    let subtotal = qty * price;
    subtotalField.value = subtotal.toLocaleString('id-ID');
}

function calculateTotal() {
    let subtotalFields = document.querySelectorAll('.subtotal');
    let total = 0;

    subtotalFields.forEach(s => {
        let val = Number(s.value.replace(/\./g, '').replace(',', '.'));
        total += isNaN(val) ? 0 : val;
    });

    document.getElementById('grandTotal').innerText =
        "Rp " + total.toLocaleString('id-ID');
}

document.getElementById('addRow').addEventListener('click', function () {

    let table = document.querySelector('#itemTable tbody');

    let row = `
        <tr class="intro-x border-b hover:bg-gray-50 transition">
            <td class="p-2">
                <select name="items[${rowIndex}][product_id]" class="input border w-full">
                    @foreach($products as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
            </td>

            <td class="text-center p-2">
                <input type="number" name="items[${rowIndex}][qty]"
                       class="input w-20 border qty text-center" value="1">
            </td>

            <td class="text-center p-2">
                <input type="number" step="0.01"
                       name="items[${rowIndex}][price]"
                       class="input w-32 border price text-center"
                       placeholder="0">
            </td>

            <td class="text-center p-2">
                <input type="text" class="input w-32 border subtotal text-center" disabled>
            </td>

            <td class="text-center p-2">
                <button type="button"
                    class="button bg-theme-6 text-white px-2 py-1 removeRow">
                    <i data-feather="trash-2" class="w-4 h-4"></i>
                </button>
            </td>
        </tr>
    `;

    table.insertAdjacentHTML('beforeend', row);

    rowIndex++;

    // feather icon fix
    feather.replace();
});

// kalkulasi otomatis
document.addEventListener('input', function (e) {
    if (e.target.classList.contains('qty') || e.target.classList.contains('price')) {
        let row = e.target.closest('tr');
        calculateRow(row);
        calculateTotal();
    }
});

// hapus baris
document.addEventListener('click', function(e) {
    if (e.target.closest('.removeRow')) {
        e.target.closest('tr').remove();
        calculateTotal();
    }
});
</script>

@endsection
