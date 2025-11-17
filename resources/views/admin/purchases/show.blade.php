@extends('layouts.main')

@section('content')
<div class="content">

    {{-- HEADER --}}
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Detail Pembelian
        </h2>

        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">

            {{-- BUTTON PRINT --}}
            <a href="{{ route('purchases.print', $purchase->id) }}" target="_blank"
                class="button text-white bg-theme-1 shadow-md mr-2">
                <i data-feather="printer" class="w-4 h-4 mr-1"></i> Print
            </a>

        </div>
    </div>

    <!-- BEGIN: Invoice -->
    <div class="intro-y box overflow-hidden mt-5">

        {{-- HEADER INVOICE --}}
        <div class="border-b border-gray-200 text-center sm:text-left">
            <div class="px-5 py-10 sm:px-20 sm:py-20">
                <div class="text-theme-1 font-semibold text-3xl">INVOICE PEMBELIAN</div>

                <div class="mt-2">
                    No Invoice :
                    <span class="font-medium">{{ $purchase->invoice_number }}</span>
                </div>

                <div class="mt-1">
                    {{ optional($purchase->created_at)->format('d M Y') }}
                </div>
            </div>

            {{-- DETAIL SUPPLIER & USER --}}
            <div class="flex flex-col lg:flex-row px-5 sm:px-20 pt-10 pb-10 sm:pb-20">

                {{-- SUPPLIER --}}
                <div>
                    <div class="text-base text-gray-600">Supplier</div>
                    <div class="text-lg font-medium text-theme-1 mt-2">
                        {{ $purchase->supplier->name ?? '-' }}
                    </div>
                    <div class="mt-1">{{ $purchase->supplier->phone ?? '-' }}</div>
                    <div class="mt-1">{{ $purchase->supplier->address ?? '-' }}</div>
                </div>

                {{-- USER --}}
                <div class="lg:text-right mt-10 lg:mt-0 lg:ml-auto">
                    <div class="text-base text-gray-600">Dibuat oleh</div>
                    <div class="text-lg font-medium text-theme-1 mt-2">
                        {{ $purchase->user->name ?? 'User' }}
                    </div>
                    <div class="mt-1">
                        {{ optional($purchase->created_at)->format('d M Y H:i') }}
                    </div>
                </div>

            </div>
        </div>

        {{-- TABEL ITEM --}}
        <div class="px-5 sm:px-16 py-10 sm:py-20">
            <div class="overflow-x-auto">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="border-b-2 whitespace-no-wrap">NAMA PRODUK</th>
                            <th class="border-b-2 text-right whitespace-no-wrap">QTY</th>
                            <th class="border-b-2 text-right whitespace-no-wrap">HARGA</th>
                            <th class="border-b-2 text-right whitespace-no-wrap">SUBTOTAL</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($purchase->items ?? [] as $item)
                        <tr>
                            <td class="border-b">
                                <div class="font-medium">
                                    {{ $item->product->name ?? 'Produk hilang' }}
                                </div>
                            </td>

                            <td class="text-right border-b w-32">
                                {{ $item->qty }}
                            </td>

                            <td class="text-right border-b w-32">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </td>

                            <td class="text-right border-b w-32 font-medium">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

        {{-- TOTAL --}}
        <div class="px-5 sm:px-20 pb-10 sm:pb-20 flex flex-col-reverse sm:flex-row">

            {{-- METODE BAYAR --}}
            <div class="text-center sm:text-left mt-10 sm:mt-0">
                <div class="text-base text-gray-600">Metode Pembayaran</div>
                <div class="text-lg text-theme-1 font-medium mt-2">
                    {{ ucfirst($purchase->payment_method) }}
                </div>
            </div>

            {{-- TOTAL --}}
            <div class="text-center sm:text-right sm:ml-auto">
                <div class="text-base text-gray-600">Total Pembelian</div>
                <div class="text-xl text-theme-1 font-medium mt-2">
                    Rp {{ number_format($purchase->total, 0, ',', '.') }}
                </div>
                <div class="mt-1 text-xs">Termasuk pajak bila ada</div>
            </div>

        </div>
    </div>
    <!-- END: Invoice -->

</div>
@endsection
