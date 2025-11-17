@extends('layouts.main')

@section('content')
<h2 class="intro-y text-lg font-medium mt-10">
    Data List User
</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <a href="{{route('users.create')}}" class="button text-white bg-theme-1 shadow-md mr-2">Add New User</a>
        <div class="hidden md:block mx-auto text-gray-600">Showing {{count($users)}} entries</div>
        <form method="GET" action="{{ route('users.index') }}">
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
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-9 text-white"> <i data-feather="alert-triangle"
                class="w-6 h-6 mr-2"></i>{{session('success')}}</div>
        @endif
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-no-wrap">No</th>
                    <th class="whitespace-no-wrap">Name</th>
                    <th class="text-center whitespace-no-wrap">Email</th>
                    <th class="text-center whitespace-no-wrap">Role</th>
                    <th class="text-center whitespace-no-wrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $us)
                <tr class="intro-x">
                    <td class="w-40">
                        <div class="flex">
                            {{$loop->iteration}}
                        </div>
                    </td>
                    <td>
                        <a href="" class="font-medium whitespace-no-wrap">{{$us->name}}</a>
                        <div class="text-gray-600 text-xs whitespace-no-wrap">{{$us->email}}</div>
                    </td>
                    <td class="text-center">{{$us->email}}</td>
                    <td class="w-40">
                        <div class="flex items-center justify-center text-theme-6" class="w-4 h-4 mr-2"></i>
                            {{$us->role}}</div>
                    </td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3" href="{{ route('users.edit', $us->id) }}">
                                <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                            </a>

                            <form action="{{ route('users.destroy', $us->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this user?');">
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
                <tr class="intro-x">
                    <td colspan="5" class="text-center">Tidak ada data user.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
        {{$users->links()}}
    </div>
</div>
@endsection
