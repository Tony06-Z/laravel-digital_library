<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $user = User::paginate(10);
        return view('admin.user.index', compact('user'));
    }


    public function create()
    {
        return view('admin.user.create');
    }   
    
    public function store(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string|max:255|unique:users,username',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:6',
                'nama_lengkap' => 'required|string|max:255',
                'alamat' => 'required|string',
                'role' => 'required|in:admin,petugas,peminjam',
            ]);

        } catch (ValidationException $e) {
            dd($e->errors());
        } 
            User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password'=> Hash::make($request->password),
                'nama_lengkap' => $request->nama_lengkap,
                'alamat' => $request->alamat,
                'role' => $request->role,
            ]);

         return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }


    public function update(Request $request, string $id)
    {
        try {        
            $request->validate([
                'username' => 'required|string|max:255|unique:users,username,' . $id,
                'email' => 'required|string|max:255|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8',
                'nama_lengkap' => 'required|string|max:255|unique:users,nama_lengkap',
                'alamat' => 'required|string',
                'role' => 'required|in:admin,petugas,peminjaman',
            ]);

        } catch (ValidationException $e) {
            dd($e->errors());
        }


            $user = User::findOrFail($id);
            $user->username = $request->username;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->nama_lengkap = $request->nama_lengkap;
            $user->alamat = $request->alamat;
            $user->role = $request->role;
            $user->save();

            return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    
    public function search()
    {
        
    }

    
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if($user->role === 'admin') {

            // If the authenticated not admin, 
            if (Auth::user()->role !== 'admin') {
                return redirect()->back()->with('error', 'Anti tidak memiliki izin untuk menghapus admin lain');
            }
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }

}
