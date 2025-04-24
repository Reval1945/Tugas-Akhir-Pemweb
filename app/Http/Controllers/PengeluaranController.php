<?php

namespace App\Http\Controllers;

use App\Models\JenisTransaksi;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;    

class PengeluaranController extends Controller
{
    public function pengeluaranPage(){
        $jenis = JenisTransaksi::all();
        return view('pengeluaran', ['jenises' => $jenis]);
    }
    

public function store(Request $request)
{
    $request->validate([
        'tanggal' => 'required|date',
        'jenis_id' => 'required|exists:jenis_transaksi,id',
        'nominal' => 'required|numeric',
        'keterangan' => 'nullable|string'
    ]);

    Pengeluaran::create($request->all());
    return back()->with('success', 'Pengeluaran berhasil ditambahkan!');
}
}
