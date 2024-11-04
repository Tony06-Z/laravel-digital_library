<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function showUserForm()
    {
        
        $buku = Buku::paginate(3);

        return view('peminjam.dashboard', compact('buku'));
    }
}
