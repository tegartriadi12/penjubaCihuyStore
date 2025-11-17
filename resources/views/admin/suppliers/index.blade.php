@extends('layouts.main')

@section('content')
<h2 class="intro-y text-lg font-medium mt-10">
    Data List Supplier
</h2>

<div class="grid grid-cols-12 gap-6 mt-5">

    {{-- Header --}}
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <a href="{{ route('suppliers.create') }}" class="button text-white bg-theme-1 shadow-md mr-2">
            Add New Supplier
        </a>

        <div class="hidden md:block mx-auto text-gray-600">
            Showing {{ count($suppliers) }} entries
        </div>

        <form method="GET" action="{{ route('suppliers.index') }}">
            <div class="w-56 relative text-gray-700">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="input w-56 box pr-10 placeholder-theme-13"
                       placeholder="Search...">
                <button type="submit" class="absolute inset-y-0 right-0 px-3">
                    <i data-feather="search" class="w-4 h-4"></i>
                </button>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

        @if (session('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-9 text-white">
            <i data-feather="check-circle" class="w-6 h-6 mr-2"></i>
            {{ session('success') }}
        </div>
        @endif

        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th>No</th>
                    <th class="whitespace-no-wrap">Name</th>
                    <th class="text-center whitespace-no-wrap">Phone</th>
                    <th class="text-center whitespace-no-wrap">Address</th>
                    <th class="text-center whitespace-no-wrap">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($suppliers as $sup)
                <tr class="intro-x">

                    <td class="w-20">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        <span class="font-medium whitespace-no-wrap">{{ $sup->name }}</span>
                        @if ($sup->description)
                        <div class="text-xs text-gray-600 whitespace-no-wrap">{{ $sup->description }}</div>
                        @endif
                    </td>

                    <td class="text-center whitespace-no-wrap">
                        {{ $sup->phone ?? '-' }}
                    </td>

                    <td class="text-center whitespace-no-wrap">
                        {{ $sup->address ?? '-' }}
                    </td>

                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">

                            {{-- EDIT --}}
                            <a href="{{ route('suppliers.edit', $sup->id) }}"
                               class="flex items-center mr-3">
                                <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                            </a>

                            {{-- DELETE --}}
                            <form action="{{ route('suppliers.destroy', $sup->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus supplier ini?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="flex items-center text-theme-6 bg-transparent border-0 p-0">
                                    <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Hapus
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="5" class="text-center py-3 text-gray-600">
                        Tidak ada data supplier.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{-- Pagination --}}
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
        {{ $suppliers->links() }}
    </div>
</div>
@endsection
