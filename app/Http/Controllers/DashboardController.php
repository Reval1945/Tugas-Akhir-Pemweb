<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $totalTransaksi = Transaksi::sum('nominal');
    $totalPemasukan = Transaksi::where('tipe_transaksi',1)->sum('nominal');
    $totalPengeluaran = Transaksi::where('tipe_transaksi',0)->sum('nominal');
    // $totalPengeluaran = Pengeluaran::sum('nominal');
    $saldoBersih = $totalPemasukan - $totalPengeluaran;



    $bulan = 5; // Mei
    $tahun = 2025;

    $transaksiHarian = DB::table('transaksi')
        ->selectRaw('DAY(created_at) as hari, COUNT(*) as total')
        ->whereMonth('created_at', $bulan)
        ->whereYear('created_at', $tahun)
        ->groupBy('hari')
        ->orderBy('hari')
        ->pluck('total', 'hari'); // hasilnya: [1 => 5, 2 => 12, ...]

    $labels = range(1, 31);
    $data = [];

    foreach ($labels as $hari) {
        $data[] = $transaksiHarian[$hari] ?? 0; // default 0 jika tidak ada transaksi
    }

    // return view('dashboard', [

    // ]);


    return view('dashboard', [
        'totalTransaksi' => $totalTransaksi,
        'totalPemasukan' => $totalPemasukan,
        'totalPengeluaran' => $totalPengeluaran,
        'saldoBersih' => $saldoBersih,
        'labels' => $labels,
        'data' => $data,
    ]);

}
}
