<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $query = User::query();

    // Jika ada keyword pencarian
    if ($request->has('search') && !empty($request->search)) {
        $keyword = $request->search;
        $query->where(function($q) use ($keyword) {
            $q->where('name', 'like', "%{$keyword}%")
              ->orWhere('email', 'like', "%{$keyword}%");
        });
    }

    $users = $query->paginate(5)->withQueryString(); // pagination + mempertahankan query string
    return view('admin.users.index', compact('users'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|unique:users,email',
            'name'     => 'required',
            'password' => 'required|min:4',
            'role'     => 'required|in:admin,kasir,gudang,owner'
        ]);

        User::create([
            'email'    => $request->email,
            'name'     => $request->name,
            'password' => Hash::make($request->password), // hash password
            'role'     => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'name'     => 'required',
            'password' => 'nullable|min:4',
            'role'     => 'required|in:admin,kasir,gudang,owner'
        ]);

        $data = [
            'email' => $request->email,
            'name'  => $request->name,
            'role'  => $request->role,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Berhasil memperbarui data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Berhasil menghapus data');
    }
}
