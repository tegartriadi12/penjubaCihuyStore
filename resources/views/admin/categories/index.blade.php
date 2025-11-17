@extends('layouts.main')

@section('content')

<h2 class="intro-y text-lg font-medium mt-10">
    Data List Category
</h2>

<div class="grid grid-cols-12 gap-6 mt-5">

    {{-- Header: Add Button + Showing Count + Search --}}
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">

        <a href="{{ route('categories.create') }}"
           class="button text-white bg-theme-1 shadow-md mr-2">
            Add New Category
        </a>

        <div class="hidden md:block mx-auto text-gray-600 text-sm">
            Showing {{ $categories->count() }} entries
        </div>

        <form method="GET" action="{{ route('categories.index') }}" class="w-full sm:w-auto">
            <div class="w-56 relative text-gray-700">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="input w-56 box pr-10 placeholder-theme-13"
                       placeholder="Search...">
                <button type="submit" class="absolute inset-y-0 right-0 flex items-center px-3">
                    <i data-feather="search" class="w-4 h-4"></i>
                </button>
            </div>
        </form>

    </div>

    {{-- Table --}}
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

        {{-- Success Message --}}
        @if (session('success'))
            <div class="rounded-md flex items-center px-5 py-4 mb-4 bg-theme-9 text-white">
                <i data-feather="check-circle" class="w-5 h-5 mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-report mt-2">
            <thead>
                <tr>
                    <th class="whitespace-no-wrap">No</th>
                    <th class="whitespace-no-wrap">Name</th>
                    <th class="text-center whitespace-no-wrap">Description</th>
                    <th class="text-center whitespace-no-wrap">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($categories as $category)
                <tr class="intro-x">

                    {{-- Number --}}
                    <td class="w-20">
                        {{ $loop->iteration }}
                    </td>

                    {{-- Name --}}
                    <td>
                        <span class="font-medium whitespace-no-wrap">
                            {{ $category->name }}
                        </span>
                    </td>

                    {{-- Description --}}
                    <td class="text-center whitespace-no-wrap">
                        {{ $category->description }}
                    </td>

                    {{-- Actions --}}
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">

                            {{-- Edit --}}
                            <a href="{{ route('categories.edit', $category->id) }}"
                               class="flex items-center mr-3">
                                <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('categories.destroy', $category->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus kategori ini?');">
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
                    <td colspan="4" class="text-center py-3 text-gray-600">
                        Tidak ada data category.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    {{-- Pagination --}}
    <div class="intro-y col-span-12 flex justify-center mt-4">
        {{ $categories->links() }}
    </div>

</div>

@endsection
