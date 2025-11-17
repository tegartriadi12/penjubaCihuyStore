@extends('layouts.main')

@section('content')
<h2 class="text-lg font-bold mt-5">Return Barang</h2>

<form action="{{ route('returns.store') }}" method="POST">
    @csrf

    <label>Pilih Transaksi</label>
    <select name="transaction_id" id="transactionSelect" class="form-control" required>
        <option value="">-- Pilih Transaksi --</option>
        @foreach($transactions as $t)
        <option value="{{ $t->id }}">
            {{ $t->invoice_number }} - {{ $t->created_at->format('d/m/Y') }}
        </option>
        @endforeach
    </select>

    <div id="itemsContainer" class="mt-5"></div>

    <button type="submit" class="button bg-theme-1 text-white mt-5">Simpan</button>
</form>

<script>
document.getElementById('transactionSelect').addEventListener('change', function() {

    let id = this.value;

    fetch('/api/transaction/' + id)
        .then(res => res.json())
        .then(data => {
            let html = `
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Qty Beli</th>
                            <th>Qty Return</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            data.items.forEach(item => {
                html += `
                    <tr>
                        <td>${item.product.name}</td>
                        <td>${item.price}</td>
                        <td>${item.qty}</td>
                        <td>
                            <input type="number" name="items[${item.id}][qty]" class="form-control" min="0" max="${item.qty}">
                            <input type="hidden" name="items[${item.id}][product_id]" value="${item.product_id}">
                            <input type="hidden" name="items[${item.id}][price]" value="${item.price}">
                        </td>
                    </tr>
                `;
            });

            html += `</tbody></table>`;

            document.getElementById('itemsContainer').innerHTML = html;
        });
});
</script>

@endsection
