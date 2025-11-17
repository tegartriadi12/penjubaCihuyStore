@extends('layouts.main')

@section('content')
<h2 class="text-lg font-bold mt-5">Detail Return Barang</h2>

<p>No Return: <strong>{{ $return->return_number }}</strong></p>
<p>Tanggal: {{ $return->created_at->format('d/m/Y H:i') }}</p>

<h4 class="mt-5">Detail Barang Dikembalikan:</h4>

<table class="table mt-3">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($return->items as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->qty }}</td>
            <td>Rp {{ number_format($item->price,0,',','.') }}</td>
            <td>Rp {{ number_format($item->subtotal,0,',','.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('returns.print',$return->id) }}" target="_blank" class="button bg-theme-1 text-white mt-5">Cetak</a>

@endsection
