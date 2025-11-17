@extends('layouts.main')

@section('content')
<h2 class="intro-y text-lg font-medium mt-10">Data Pembelian</h2>

<div class="grid grid-cols-12 gap-6 mt-5">

    <!-- Header: tombol tambah, search, info -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">

        <a href="{{ route('purchases.create') }}"
           class="button bg-theme-1 text-white shadow-md mr-2">
            + Tambah Pembelian
        </a>

        <div class="hidden md:block mx-auto text-gray-600">
            Menampilkan {{ $purchases->count() }} data
        </div>

        <form method="GET" action="{{ route('purchases.index') }}">
            <div class="relative w-56">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="input w-56 box pr-10 placeholder-theme-13"
                       placeholder="Cari invoice ...">

                <button type="submit"
                        class="absolute inset-y-0 right-0 px-3 flex items-center">
                    <i data-feather="search" class="w-4 h-4"></i>
                </button>
            </div>
        </form>

    </div>

    <!-- Table -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

        @if (session('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-4 bg-theme-9 text-white">
            <i data-feather="check-circle" class="w-6 h-6 mr-2"></i>
            {{ session('success') }}
        </div>
        @endif

        <div class="box p-5">

            <table class="table table-report w-full">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Invoice</th>
                        <th>Supplier</th>
                        <th>Total</th>
                        <th>Pembayaran</th>
                        <th>Status</th>
                        <th>User</th>
                        <th class="text-center w-32">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($purchases as $p)
                    <tr class="intro-x">

                        <td class="font-medium">{{ $p->invoice_number }}</td>

                        <td>{{ $p->supplier->name }}</td>

                        <td>Rp {{ number_format($p->total, 0, ',', '.') }}</td>

                        <td>{{ ucfirst($p->payment_method) }}</td>

                        <td>
                            @if ($p->payment_status == 'paid')
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                    PAID
                                </span>
                            @else
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">
                                    UNPAID
                                </span>
                            @endif
                        </td>

                        <td>{{ $p->user->name }}</td>

                        <td class="table-report__action text-center">
                            <div class="flex justify-center items-center">
                                <a href="{{ route('purchases.show', $p->id) }}"
                                   class="flex items-center text-theme-9 mr-3">
                                    <i data-feather="zoom-in" class="w-4 h-4 mr-1"></i>
                                    Detail
                                </a>
                            </div>
                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-600 py-4">
                            Tidak ada data pembelian.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>

    <!-- Pagination -->
    <div class="intro-y col-span-12">
        {{ $purchases->links() }}
    </div>

</div>

<script>
    feather.replace();
</script>

@endsection
