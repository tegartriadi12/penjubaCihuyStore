@extends('layouts.main')

@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Form Edit Unit
    </h2>
</div>

<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">

        <!-- BEGIN: Form Layout -->
        <div class="intro-y box p-5">
            <form action="{{ route('units.update', $unit->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- NAME -->
                <div>
                    <label class="font-medium">Name</label>
                    <input type="text"
                           name="name"
                           value="{{ old('name', $unit->name) }}"
                           class="input w-full border mt-2 @error('name') border-theme-6 @enderror"
                           placeholder="Input units name">
                    @error('name')
                        <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- DESCRIPTION -->
                <div class="mt-3">
                    <label class="font-medium">Description (optional)</label>
                    <textarea name="description"
                              class="input w-full border mt-2 @error('description') border-theme-6 @enderror"
                              placeholder="Input description">{{ old('description', $unit->description) }}</textarea>
                    @error('description')
                        <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- BUTTONS -->
                <div class="text-right mt-5">
                    <a href="{{ route('units.index') }}"
                       class="button w-24 border text-gray-700 mr-1">
                        Cancel
                    </a>

                    <button type="submit" class="button w-24 bg-theme-1 text-white">
                        Update
                    </button>
                </div>

            </form>
        </div>
        <!-- END: Form Layout -->

    </div>
</div>
@endsection

