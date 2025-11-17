@extends('layouts.main')

@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Form Edit User
    </h2>
</div>

<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box p-5">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- NAME -->
                <div class="mt-3">
                    <label class="font-medium">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="input w-full border mt-2 @error('name') border-theme-6 @enderror"
                        placeholder="Input name">
                    @error('name')
                    <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- EMAIL -->
                <div class="mt-3">
                    <label class="font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="input w-full border mt-2 @error('email') border-theme-6 @enderror"
                        placeholder="Input email">
                    @error('email')
                    <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- PASSWORD -->
                <div class="mt-3">
                    <label class="font-medium">Password</label>
                    <input type="password" name="password"
                        class="input w-full border mt-2 @error('password') border-theme-6 @enderror"
                        placeholder="Kosongkan jika tidak ingin mengubah password">
                    @error('password')
                    <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ROLE -->
                <div class="mt-3">
                    <label class="font-medium">Role</label>
                    <select name="role" class="select2 w-full border mt-2">
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="kasir" {{ old('role', $user->role) == 'kasir' ? 'selected' : '' }}>Kasir</option>
                        <option value="owner" {{ old('role', $user->role) == 'owner' ? 'selected' : '' }}>Owner</option>
                        <option value="gudang" {{ old('role', $user->role) == 'gudang' ? 'selected' : '' }}>Gudang</option>
                    </select>
                    @error('role')
                    <div class="text-theme-6 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- BUTTONS -->
                <div class="text-right mt-5">
                    <a href="{{ route('users.index') }}" class="button w-24 border text-gray-700 mr-1">Cancel</a>
                    <button type="submit" class="button w-24 bg-theme-1 text-white">Simpan</button>
                </div>
            </form>
        </div>
        <!-- END: Form Layout -->
    </div>
</div>
@endsection
