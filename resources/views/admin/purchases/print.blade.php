<!DOCTYPE html>
<html>
<head>
    <title>Invoice Pembelian - {{ $purchase->invoice_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #333;
        }

        .container {
            width: 100%;
            margin: auto;
        }

        .header {
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .sub-info {
            margin-top: 5px;
            line-height: 1.4;
        }

        h4 {
            margin-bottom: 5px;
            margin-top: 20px;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
            font-size: 13px;
        }

        table th {
            background: #f2f2f2;
            border: 1px solid #000;
            padding: 6px;
            font-weight: bold;
            text-align: left;
        }

        table td {
            border: 1px solid #000;
            padding: 6px;
        }

        .text-right {
            text-align: right;
        }

        .total-box {
            margin-top: 20px;
            width: 250px;
            float: right;
            border: 1px solid #000;
            padding: 10px;
            background: #fafafa;
        }

        .total-box div {
            display: flex;
            justify-content: space-between;
            font-size: 15px;
            font-weight: bold;
        }

        @media print {
            @page {
                size: A4;
                margin: 12mm;
            }
        }
    </style>
</head>
<body onload="window.print()">

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div class="title">INVOICE PEMBELIAN</div>
        <div class="sub-info">
            <strong>No Invoice:</strong> {{ $purchase->invoice_number }}<br>
            <strong>Tanggal:</strong> {{ optional($purchase->created_at)->format('d/m/Y H:i') }}
        </div>
    </div>

    <!-- SUPPLIER -->
    <h4>Informasi Supplier</h4>
    <p><strong>Nama:</strong> {{ $purchase->supplier->name ?? '-' }}</p>
    <p><strong>Telepon:</strong> {{ $purchase->supplier->phone ?? '-' }}</p>
    <p><strong>Alamat:</strong> {{ $purchase->supplier->address ?? '-' }}</p>

    <!-- PEMBAYARAN -->
    <h4>Informasi Pembayaran</h4>
    <p><strong>Metode:</strong> {{ ucfirst($purchase->payment_method) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($purchase->payment_status) }}</p>

    <!-- DETAIL BARANG -->
    <h4>Detail Barang</h4>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th width="60">Qty</th>
                <th width="100" class="text-right">Harga</th>
                <th width="110" class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchase->items as $item)
            <tr>
                <td>{{ $item->product->name ?? 'Produk tidak ditemukan' }}</td>
                <td class="text-right">{{ $item->qty }}</td>
                <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- TOTAL -->
    <div class="total-box">
        <div>
            <span>Total</span>
            <span>Rp {{ number_format($purchase->total, 0, ',', '.') }}</span>
        </div>
    </div>

</div>

</body>
</html>
