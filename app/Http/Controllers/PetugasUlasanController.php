<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Ulasan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class PetugasUlasanController extends Controller
{
    public function index()
    {
        $ulasan = Ulasan::paginate(10);
        $buku = Buku::all();
        $user = User::all();

        return view('petugas.ulasan.index', compact('index'));
    }


    public function exportPdf()
    {
        $ulasan = Ulasan::all();
        $pdf = Pdf::loadView('pdf.export-ulasan', ['ulasan' => $ulasan])->setOption(['defaultFont' => 'sans-serif']);

        $fileName = 'export-ulasanr-' . Date::now()->format('Y-m-d_H-i-s') . 'pdf';

        return $pdf->download($fileName);
    }

    
    public function exportExcel()
    {

    }

    
    public function destroy(string $id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();

        return redirect()->route('ulasan.index')
            ->with('success', 'Ulasan berhasil dihapus');
    }
}
