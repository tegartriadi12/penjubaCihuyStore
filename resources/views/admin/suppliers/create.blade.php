@extends('layouts.main')

@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Form Tambah Supplier
    </h2>
</div>

<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">

        <div class="intro-y box p-5">
            <form action="{{ route('suppliers.store') }}" method="POST">
                @csrf

                <!-- NAME -->
                <div>
                    <label class="font-medium">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="input w-full border mt-2 @error('name') border-theme-6 @enderror"
                        placeholder="Input supplier name">
                    @error('name')
                        <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- PHONE -->
                <div class="mt-3">
                    <label class="font-medium">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="input w-full border mt-2 @error('phone') border-theme-6 @enderror"
                        placeholder="Input phone number">
                    @error('phone')
                        <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ADDRESS -->
                <div class="mt-3">
                    <label class="font-medium">Address</label>
                    <textarea name="address"
                        class="input w-full border mt-2 @error('address') border-theme-6 @enderror"
                        placeholder="Input address">{{ old('address') }}</textarea>
                    @error('address')
                        <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- DESCRIPTION -->
                <div class="mt-3">
                    <label class="font-medium">Description (optional)</label>
                    <textarea name="description"
                        class="input w-full border mt-2 @error('description') border-theme-6 @enderror"
                        placeholder="Input description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- BUTTONS -->
                <div class="text-right mt-5">
                    <a href="{{ route('suppliers.index') }}" class="button w-24 border text-gray-700 mr-1">
                        Cancel
                    </a>
                    <button type="submit" class="button w-24 bg-theme-1 text-white">
                        Simpan
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection
