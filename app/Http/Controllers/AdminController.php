<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdminForm()
    {
        $bukuCount = Buku::count();
        $kategoriCount = Kategori::count();
        $usersCount = User::count();
        $peminjamanCount = Peminjaman::count();

        return view('admin.dashboard', ['buku_count' => $bukuCount, 'kategori_count' => $kategoriCount, 'users_count' => $usersCount, 'peminjaman_count' => $peminjamanCount]);
    }
}
