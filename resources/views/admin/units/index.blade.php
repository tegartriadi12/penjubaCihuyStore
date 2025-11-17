@extends('layouts.main')

@section('content')
<h2 class="intro-y text-lg font-medium mt-10">
    Data List Unit
</h2>

<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <a href="{{ route('units.create') }}" class="button text-white bg-theme-1 shadow-md mr-2">
            Add New Unit
        </a>
        <div class="hidden md:block mx-auto text-gray-600">Showing {{ count($units) }} entries</div>

        <form method="GET" action="{{ route('units.index') }}">
            <div class="w-56 relative text-gray-700">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                <button type="submit" class="absolute inset-y-0 right-0 px-3">
                    <i data-feather="search" class="w-4 h-4"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        @if (session('success'))
            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-9 text-white">
                <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th>No</th>
                    <th class="whitespace-no-wrap">Name</th>
                    <th class="whitespace-no-wrap">Description</th>
                    <th class="text-center whitespace-no-wrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($units as $unit)
                <tr class="intro-x">
                    <td>{{ $loop->iteration }}</td>
                    <td class="font-medium">{{ $unit->name }}</td>
                    <td>{{ $unit->description }}</td>

                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a href="{{ route('units.edit', $unit->id) }}" class="flex items-center mr-3">
                                <i data-feather="check-square" class="w-4 h-4 mr-1"></i>Edit
                            </a>

                            <form action="{{ route('units.destroy', $unit->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus unit ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="flex items-center text-theme-6">
                                    <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data unit.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="intro-y col-span-12">
        {{ $units->links() }}
    </div>
</div>
@endsection
