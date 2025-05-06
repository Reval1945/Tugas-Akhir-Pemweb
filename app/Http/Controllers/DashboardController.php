<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $totalTransaksi = Transaksi::sum('nominal');
    $totalPemasukan = Transaksi::where('tipe_transaksi',1)->sum('nominal');
    $totalPengeluaran = Transaksi::where('tipe_transaksi',0)->sum('nominal');
    // $totalPengeluaran = Pengeluaran::sum('nominal');
    $saldoBersih = $totalPemasukan - $totalPengeluaran;

    return view('dashboard', compact(
        'totalTransaksi',
        'totalPemasukan',
        'totalPengeluaran',
        'saldoBersih'
    ));
}
}
