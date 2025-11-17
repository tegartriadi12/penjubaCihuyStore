@extends('layouts.main')

@section('content')
<h2 class="text-lg font-bold mt-5">Data Return Barang</h2>

<a href="{{ route('returns.create') }}" class="button bg-theme-1 text-white mt-3">Buat Return Baru</a>

<table class="table mt-5">
    <thead>
        <tr>
            <th>No Return</th>
            <th>Transaksi</th>
            <th>User</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($returns as $r)
        <tr>
            <td>{{ $r->return_number }}</td>
            <td>{{ $r->transaction_id }}</td>
            <td>{{ $r->user->name }}</td>
            <td>{{ $r->created_at->format('d/m/Y H:i') }}</td>
            <td>
                <a href="{{ route('returns.show',$r->id) }}" class="btn btn-info">Detail</a>
                <a href="{{ route('returns.print',$r->id) }}" class="btn btn-primary" target="_blank">Cetak</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
