<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PetugasBukuController extends Controller
{
    public function index()
    {
        $buku = Buku::orderBy('created_at', 'desc')->paginate(10);
        $kategori = Kategori::all();
        return view('petugas.buku.index', compact('buku', 'kategori'));
    }


    public function create()
    {
        $kategori = Kategori::all();
        return view('petugas.create.buku', ['kategori' => $kategori]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'sampul' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'required',
            'penerbit' => 'required',
            'stock' => 'required',
            'tahun_terbit' => 'required|numeric',
            'kategori_id' => 'required',
        ]);

        $sampul = $request->file('sampul');
        $sampul_name = Str::random(20) . '.' .$sampul->getClientOriginalExtension();
        $sampul->storeAs('public/buku/', $sampul_name);

         Buku::create([
            'judul' => $request->get('judul'),
            'sampul' => $sampul_name,
            'penulis' => $request->get('penulis'),
            'penerbit' => $request->get('penerbit'),
            'stock' => $request->get('stock'),
            'tahun_terbit' => $request->get('tahun_terbit'),
            'kategori_id' => $request->get('kategori_id'),
        ]);

        return redirect('/petugas/buku')->with('success', 'Buku berhasil ditambahkan');
    }
}
