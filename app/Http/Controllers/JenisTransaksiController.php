<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisTransaksi;
use App\Helper\Helper;


class JenisTransaksiController extends Controller
{
    // Menampilkan semua data Jenis Transaksi
    public function index()
    {
        // Ambil semua data dari tabel jenis_transaksis
        $data = JenisTransaksi::all();

        // Tampilkan ke view 'jenis' dan kirimkan datanya
        return view('jenis', ['datas' => $data]);
    }


    /**
 * Untuk menambah data jenis transaksi
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
 */
    public function addJenisTransaksi(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_transaksi' => 'required|string',
        ]);

        // Buat ID custom dengan helper
        $jenisId = Helper::IDGenerator(new JenisTransaksi(), 'jenis_id', 5, 'JN');

        // Simpan data jenis transaksi
        JenisTransaksi::create([
            'nama_transaksi' => $request->nama_transaksi,
            'jenis_id'       => $jenisId,
        ]);

        // Redirect kembali ke halaman daftar jenis transaksi
        return redirect('/jenis')->with('success', 'Jenis transaksi berhasil ditambahkan!');
    }

    /**
 * Menampilkan Halaman Edit dengan mengirimkan parameter ID
 * 
 * @param mixed $id
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
 */
    public function editJenisTransaksiPage($id)
    {
        // Mengambil data jenis transaksi berdasarkan id
        $data = JenisTransaksi::find($id);

        return view('edit-jenis', ['jenisTransaksi' => $data]);
    }

/**
 * Menangani Proses edit jenis transaksi
 * 
 * @param \Illuminate\Http\Request $request
 * @param mixed $id
 * @return \Illuminate\Http\RedirectResponse|mixed
 */
    public function editJenisTransaksi(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_transaksi' => 'required|string'
        ]);

        $jenisTransaksi = JenisTransaksi::find($id);

        if ($jenisTransaksi) {
            // Mengganti nama transaksi dengan data yang dikirim
            $jenisTransaksi->nama_transaksi = $request->nama_transaksi;

            // Proses update data jenis transaksi
            $jenisTransaksi->save();

            return redirect('/jenis')->with('success', 'Jenis Transaksi berhasil diperbarui.');
        } else {
            return redirect('/jenis')->with('error', 'Jenis Transaksi tidak ditemukan.');
        }
    }
    /**
 * Fungsi untuk proses menghapus jenis transaksi
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  mixed  $id
 * @return \Illuminate\Http\RedirectResponse
 */
    public function deleteJenisTransaksi(Request $request, $id)
    {
        // Mencari jenis transaksi berdasarkan ID
        $jenisTransaksi = JenisTransaksi::find($id);

        // Jika data ditemukan, hapus data
        if ($jenisTransaksi) {
            $jenisTransaksi->delete();
            return redirect('/jenis')->with('success', 'Jenis Transaksi deleted successfully.');
        } else {
            // Jika data tidak ditemukan
            return redirect('/jenis')->with('error', 'Jenis Transaksi not found.');
        }
    }


}
