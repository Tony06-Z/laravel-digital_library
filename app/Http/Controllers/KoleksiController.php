<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Koleksi;
use Illuminate\Http\Request;

class KoleksiController extends Controller
{
    public function index()
    {
        $favorite = Favorite::with(['user', 'buku'])->get();

        return view('peminjam.favorite', ['data' => $favorite]);
    }

    public function addFavorite()
    {

    }

    public function buku_anda()
    {
        $koleksi = Koleksi::with(['user', 'buku'])->get();

        return view('peminjam.buku-anda', ['data' => $koleksi]);
    }
}
