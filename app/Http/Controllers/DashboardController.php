<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBukuRelasi;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $bookCountPerCategory = KategoriBukuRelasi::with('kategori')->selectRaw('count(*) as count, kategori_id')->groupBy('kategori_id')->get();

        $borrowedBooksOverTime = Peminjaman::selectRaw('date(tgl_peminjaman) as date, count(*) as count')->groupBy('date')->get();

        return view('admin.dashboard', compact('bookCountPerCategory', 'borrowedBooksOverTime'));
    }
}
