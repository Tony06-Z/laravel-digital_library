<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Koleksi;
use App\Models\Peminjaman;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function pinjamBuku(string $id)
    {
        if (Auth::check()) {
            $buku = Buku::findOrFail($id);
            $user = auth()->user();

            $isAlreadyBorrowed = Peminjaman::where('user_id', $user->id)
                ->where('buku_id', $buku->id)
                ->where('status_peminjaman', 'Dipinjam')
                ->exists();

            if ($isAlreadyBorrowed) {
                return redirect()->back()->with('error', 'Anda sudah meminjam buku ini sebelumnya.');
            }

            $peminjaman = Peminjaman::create([
                'user_id' => $user->id,
                'buku_id' => $buku->id,
                'status_tunggu' => 'tunggu'
            ]);

            $user = auth()->user();
            Koleksi::create([
                'user_id' => $user->id,
                'buku_id' => $buku->id,
                'peminjaman_id' => $peminjaman->id,
            ]);

            return redirect()->back()->with('success', 'Peminjaman Berhasil.');
        } else {

            return redirect()->route('login')->with('error', 'Sebelum meminjam, Mohon login terlebih dahulu');
        }
    }

    
    public function kembalikanBuku(string $id, Request $request) 
    {
        $request->validate([
            'comment' => 'required|max:200',
            'rating' => 'required|integer|between:1,5',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'tanggal_pengembalian' => now(),
            'status_tunggu' => 'pengembalian',
        ]);

        $ulasanBukuData = [
            'user_id' => auth()->user()->id,
            'buku_id' => $peminjaman->buku_id,
            'ulasan' => $request->input('comment'),
            'rating' => $request->input('rating'),
        ];

        Ulasan::create($ulasanBukuData);

        return redirect()->back()->with('success', 'Buku telah ditambahkan.');
    }
}
