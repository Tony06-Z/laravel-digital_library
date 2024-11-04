<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::paginate(50);
        $kategori = Kategori::all();
        return view('admin.buku.index', compact('buku', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.buku.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validator = Validator::make(
         $request->all(), [
            'judul' => 'required',
            'sampul' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'required',
            'penerbit' => 'required',
            'stock' => 'required',
            'tahun_terbit' => 'required|numeric',
            'kategori_id' => 'required,'
         ]);


        $sampul = $request->file('sampul');
        $sampul_name = Str::random(20) . '.' . $sampul->getClientOriginalExtension();
        $sampul->storeAs('public/buku', $sampul_name);
        
        $buku = new Buku([
            'judul' => $request->get('judul'),
            'sampul' => $sampul_name,
            'penulis' => $request->get('penulis'),
            'penerbit' => $request->get('penerbit'),
            'stock' => $request->get('stock'),
            'tahun_terbit' => $request->get('tahun_terbit'),
            'kategori_id' => $request->get('kategori_id'),
        ]);
        $buku->save();

        return redirect()->route('buku.index')
            ->with('success', 'buku berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   $buku = Buku::find($id);
        $kategori = Kategori::all();
        return view('admin.buku.edit', compact('buku', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),[
                'judul' => 'required',
                'penulis' => 'required',
                'penerbit' => 'required',
                'stock' => 'required',
                'tahun_terbit' => 'required|integer',
                'kategori_id' => 'required|exists:kategori,id',
            ]
        );
            $buku = Buku::find($id);
            $buku->judul = $request->judul;
            $buku->penulis = $request->penulis;
            $buku->penerbit = $request->penerbit;
            $buku->stock = $request->stock;
            $buku->tahun_terbit = $request->tahun_terbit;
            $buku->kategori_id = $request->kategori_id;

        if ($request->hasFile('sampul')) {
            if ($buku->sampul) {
                Storage::delete('public/buku' . $buku->sampul);
                }

                $file = $request->file('sampul');
                $filename = time(). '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/buku/', $filename);
                $buku->sampul = $filename;
            }

            $buku->save();
            
            return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui');
    }

    public function search()
    {

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        Storage::delete('public/buku/'. $buku->sampul);
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus');
    }

    public function detail_buku($id)
    {
        $data = Buku::where('id', $id)->get()->first();
        $user = Auth::user();
        $buku = Buku::findOrFail($id);
        $kategori = Kategori::all();
        $userId = Auth::user()->id;

        $status_tunggu = Peminjaman::where('buku_id', $id)
            ->orderBy('created_at','desc')
            ->first();
            
        // If status was null , set nilai default
        $status = $status_tunggu ? $status_tunggu : $status_tunggu = Peminjaman::where('buku_id', $id)
            ->orderBy('created_at', 'desc')
            ->first();

        $ulasan = $buku->ulasan;
        return view('peminjam.detail-buku', compact('buku','kategori','ulasan','status'));
    }

    public function list_buku() {
        $kategori = Kategori::all();
        $data = Buku::all();
        return view('peminjam.list-buku', ['buku' => $data, 'kategori' => $kategori]);
    }
}
