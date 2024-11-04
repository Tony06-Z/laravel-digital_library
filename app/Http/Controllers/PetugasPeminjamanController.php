<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Koleksi;
use App\Models\Peminjaman;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class PetugasPeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::paginate(10);
        $users = User::all();
        $buku = Buku::all();

        return view('petugas.peminjaman.index', compact('peminjaman','users', 'buku'));
    }

    public function createPeminjaman(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exitsts:buku,id',
        ]);

        $user = User::findOrFail($request->input('user_id'));
        $buku = Buku::findOrFail($request->input('buku_id'));

        $peminjaman = Peminjaman::create([
            'user_id' => $user->id,
            'buku_id' => $buku->id,
            'tanggal_peminjaman' => now(),
            'tanggal_pengembalian' => now()->addDays(14), // Contoh: 14 hari batas peminjaman
            'status_peminjaman' => 'Dipinjam',
        ]);

        Koleksi::create([
            'user_id' => $user->id,
            'buku_id' => $buku->id,
            'peminjaman_id' => $peminjaman->id,
        ]);

        return redirect()->route('petugas.peminjaman.index')->with('success', 'Peminjaman Berhasil.');
    }

    public function search(Request $request)
    {
        
    }

    public function createPeminjamanForm()
    {
        $users = User::all();
        $buku = Buku::all();

        return view('petugas.peminjaman.create', compact('users', 'buku'));
    }

    public function exportPdf()
    {
        $peminjaman = Peminjaman::all();
        $pdf = Pdf::loadView('pdf.export-peminjaman', ['peminjaman' => $peminjaman])->setOption(['defaultFont' => 'sans-serif']);

        // Membuat pdf di waktu ini 
        $fileName = 'export-peminjaman-' . Date::now()->format('Y-m-d_H-i-s') . 'pdf';

        return $pdf->download($fileName);
    }

    
    public function exportExcel() 
    {

    }


    public function approve(Request $request, string $id)
    {

    }


    public function approve_kembali(Request $request, string $id)
    {

    }
}

