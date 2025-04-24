<?php

namespace App\Http\Controllers;

use App\Models\JenisTransaksi;
use App\Models\Pemasukan;
use Illuminate\Http\Request;    

class PemasukanController extends Controller
{
    public function pemasukanPage(){
        $jenis = JenisTransaksi::all();
        return view('pemasukan', ['jenises' => $jenis]);
    }
    

public function store(Request $request)
{
    $request->validate([
        'tanggal' => 'required|date',
        'jenis_id' => 'required|exists:jenis_transaksi,id',
        'nominal' => 'required|numeric',
        'keterangan' => 'nullable|string'
    ]);

    Pemasukan::create($request->all());
    return back()->with('success', 'Pemasukan berhasil ditambahkan!');
}
}
