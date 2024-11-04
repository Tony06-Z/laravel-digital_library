<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Koleksi;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class AdminPeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::paginate(10);
        $user = User::all();
        $buku = Buku::all();
        return view('admin.peminjaman.index', compact('peminjaman','user','buku'));
    }


    public function create()
    {
        $user = User::all();
        $buku = Buku::all();
        return view('admin.peminjaman.create', compact(['user','buku']));
    }


    // Create Peminjaman Proses
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:buku,id',
        ]);

        $user = User::findOrFail($request->input('user_id'));
        $buku = Buku::findOrFail($request->input('buku_id'));

        $peminjaman = Peminjaman::create([
            'user_id' => $user->id,
            'buku_id' => $buku->id,
            'tanggal_pengembalian' => now()->addDays(14),
            'status_peminjaman' => 'Dipinjam',
        ]);

        Koleksi::create([
            'user_id' => $user->id,
            'buku_id' => $buku->id,
            'peminjaman_id' => $peminjaman->id,
        ]);

        return redirect()->route('admin.peminjaman.index')->with('success', 'Peminjaman berhasil.');
    }

    public function search(Request $request)
    {

    }

    public function exportPdf()
    {
        $peminjaman = Peminjaman::all();

        $pdf = pdf::loadView('pdf.export-peminjaman', ['peminjaman' => $peminjaman]);
        $pdf->setOptions(['defaultFont' => 'sans-serif']);

        $fileName = 'export-peminjam-' . Date::now()->format('Y-m-d_H-i-s') . 'pdf';

        return $pdf->download($fileName);
    }

}

return $pdf->dowlona
