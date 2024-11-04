<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class PetugasKategoriController extends Controller
{
    public function index() 
    {
        $kategori = Kategori::paginate(10);
        return view('petugas.kategori.index', compact('kategori'));
    }

    
    public function create()
    {
        $kategori = Kategori::all();
        return view('petugas.kategori.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori,nama_kategori'
        ]);

        Kategori::create($request->all());

        return redirect()->route('petugas.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    
    public function show(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('petugas.kategori.show', compact('kategori'));
    }


    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('petugas.kategori.edit', compact('kategori'));
    }

    
    public function update(Request $request, string $id) 
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori,nama_kategori,' . $id
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('petugas.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function search()
    {

    }
    
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('petugas.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
