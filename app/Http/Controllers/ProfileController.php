<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        $peminjaman = Peminjaman::where('user_id', $user->id)->with(['buku'])->paginate(3);

        return view('peminjam.profile.index', ['data' => $peminjaman]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if (!$user instanceof User) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        $request->validate([
            'username' => 'required|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'profile_photo' => 'images|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {

                Storage::delete('foto/' . $user->profile_photo);
            }

            $path = $request->file('profile_photo')->store('foto', 'public');

            $user->profile_photo = $path;
        }

        $user->username = $request->input('username');
        $user->nama_lengkap = $request->input('nama_lengkap');
        $user->alamat = $request->input('alamat');
        $user->email = $request->input('email');

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');

    }
}
