@extends('layouts.main')

@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Form Edit Product
    </h2>
</div>

<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box p-5">
            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- CATEGORY --}}
                <div class="mt-3">
                    <label class="font-medium">Category</label>
                    <select name="category_id"
                        class="select2 w-full border mt-2 @error('category_id') border-theme-6 @enderror">
                        <option value="">-- Pilih Category --</option>
                        @foreach($categories as $ct)
                            <option value="{{ $ct->id }}" {{ old('category_id', $product->category_id) == $ct->id ? 'selected' : '' }}>
                                {{ $ct->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- UNIT --}}
                <div class="mt-3">
                    <label class="font-medium">Unit</label>
                    <select name="unit_id"
                        class="select2 w-full border mt-2 @error('unit_id') border-theme-6 @enderror">
                        <option value="">-- Pilih Unit --</option>
                        @foreach($units as $un)
                            <option value="{{ $un->id }}" {{ old('unit_id', $product->unit_id) == $un->id ? 'selected' : '' }}>
                                {{ $un->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('unit_id')
                        <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BARCODE --}}
                <div class="mt-3">
                    <label class="font-medium">Barcode</label>
                    <input type="text" name="barcode"
                        value="{{ old('barcode', $product->barcode) }}"
                        class="input w-full border mt-2 @error('barcode') border-theme-6 @enderror"
                        placeholder="Input Barcode">
                    @error('barcode')
                        <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- NAME --}}
                <div class="mt-3">
                    <label class="font-medium">Product Name</label>
                    <input type="text" name="name"
                        value="{{ old('name', $product->name) }}"
                        class="input w-full border mt-2 @error('name') border-theme-6 @enderror"
                        placeholder="Input product name">
                    @error('name')
                        <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- PURCHASE PRICE --}}
                <div class="mt-3">
                    <label class="font-medium">Purchase Price</label>
                    <input type="number" step="0.01" name="purchase_price"
                        value="{{ old('purchase_price', $product->purchase_price) }}"
                        class="input w-full border mt-2 @error('purchase_price') border-theme-6 @enderror"
                        placeholder="Input purchase price">
                    @error('purchase_price')
                        <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- SELLING PRICE --}}
                <div class="mt-3">
                    <label class="font-medium">Selling Price</label>
                    <input type="number" step="0.01" name="selling_price"
                        value="{{ old('selling_price', $product->selling_price) }}"
                        class="input w-full border mt-2 @error('selling_price') border-theme-6 @enderror"
                        placeholder="Input selling price">
                    @error('selling_price')
                        <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- STOCK --}}
                <div class="mt-3">
                    <label class="font-medium">Stock</label>
                    <input type="number" name="stock"
                        value="{{ old('stock', $product->stock) }}"
                        class="input w-full border mt-2 @error('stock') border-theme-6 @enderror"
                        placeholder="Input stock">
                    @error('stock')
                        <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- MIN STOCK --}}
                <div class="mt-3">
                    <label class="font-medium">Minimal Stock</label>
                    <input type="number" name="min_stock"
                        value="{{ old('min_stock', $product->min_stock) }}"
                        class="input w-full border mt-2 @error('min_stock') border-theme-6 @enderror"
                        placeholder="Input minimal stock">
                    @error('min_stock')
                        <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- DESCRIPTION --}}
                <div class="mt-3">
                    <label class="font-medium">Description</label>
                    <textarea name="description"
                        class="input w-full border mt-2 h-24 @error('description') border-theme-6 @enderror"
                        placeholder="Input description">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTONS --}}
                <div class="text-right mt-5">
                    <a href="{{ route('products.index') }}" class="button w-24 border text-gray-700 mr-1">Cancel</a>
                    <button type="submit" class="button w-24 bg-theme-1 text-white">Update</button>
                </div>
            </form>
        </div>
        <!-- END: Form Layout -->
    </div>
</div>
@endsection
