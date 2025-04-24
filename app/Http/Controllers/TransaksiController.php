<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\JenisTransaksi;
use App\Helper\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SumberDana;

class TransaksiController extends Controller
{
     // Menampilkan halaman pemasukan
     /**
 * Tampil data pemasukan ke dalam view
 * 
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
 */
    /**
 * Tampilkan data pemasukan ke dalam view
 *
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
 */
public function pemasukanPage()
{
    // Ambil semua data jenis transaksi
    $jenis = JenisTransaksi::all();
    $sumber = SumberDana::all();
    // Ambil ID user yang sedang login
    $id = Auth::id();

    // Ambil data transaksi dengan tipe pemasukan (tipe_transaksi = 1)
    $pemasukan = Transaksi::join('jenis_transaksi', 'jenis_transaksi.id', '=', 'transaksi.jenis_id')
        ->where('uid', $id)
        ->where('tipe_transaksi', 1) // 1 = pemasukan
        ->orderBy('created_at', 'desc')
        ->get([
            'transaksi.*',
            'jenis_transaksi.nama_transaksi'
        ]);

    // Kirim data ke view
    return view('pemasukan', [
        'jenises' => $jenis,
        'pemasukan' => $pemasukan,
        'sumberdanas' => $sumber
    ]);
}

// Menampilkan halaman pemasukan
     /**
 * Tampil data pemasukan ke dalam view
 * 
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
 */
    /**
 * Tampilkan data pemasukan ke dalam view
 *
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
 */
    public function pengeluaranPage()
    {
        // Ambil semua data jenis transaksi
        $jenis = JenisTransaksi::all();
        $sumber = SumberDana::all();

        // Ambil ID user yang sedang login
        $id = Auth::id();

        // Ambil data transaksi dengan tipe pemasukan (tipe_transaksi = 1)
        $pengeluaran = Transaksi::join('jenis_transaksi', 'jenis_transaksi.id', '=', 'transaksi.jenis_id')
            ->where('uid', $id)
            ->where('tipe_transaksi', 0) // 0 = pengeluaran
            ->orderBy('created_at', 'desc')
            ->get([
                'transaksi.*',
                'jenis_transaksi.nama_transaksi'
            ]);

        // Kirim data ke view
        return view('pengeluaran', [
            'jenises' => $jenis,
            'pengeluaran' => $pengeluaran,
            'sumberdanas' => $sumber
        ]);
    }
 
     // Menambahkan data pengeluaran
     /**
 * Fungsi untuk memproses tambah pemasukan
 * 
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
 */
    public function addPengeluaran(Request $request)
    {
    // Validasi data form menggunakan validator
    $validator = Validator::make($request->all(), [
        'jenis_id' => 'required|integer',
        'status' => 'required|integer',
        'nominal' => 'required|integer',
        'catatan' => 'required',
        'file' => 'required|mimes:jpg,png,jpeg,pdf|max:2048',
        'id_sumberdana' => 'required'

    ]);

    // Jika validasi gagal, kembali ke halaman pemasukan dengan error
    if ($validator->fails()) {
        return redirect('transaksi/pengeluaran/0')
            ->withErrors($validator)
            ->withInput();
    }

    // Membuat nama file dari timestamp saat upload
    $fileName = time() . '.' . $request->file->extension();

    // Upload ke dalam folder public/uploads
    $request->file->move(public_path('uploads'), $fileName);

    // Membuat ID pemasukan dengan prefix MSK
    $transaksi_id = Helper::IDGenerator(new Transaksi, 'transaksi_id', 5, 'MSK');

    // Mengambil ID user yang login
    $uid = $request->user()->id;

    // Proses input data ke tabel transaksi
    Transaksi::create([
        'transaksi_id'    => $transaksi_id,
        'uid'             => $uid,
        'tipe_transaksi'  => 0, // 0 = Pengeluaran
        'status'          => $request->status,
        'jenis_id'        => $request->jenis_id,
        'nominal'         => $request->nominal,
        'catatan'         => $request->catatan,
        'file'            => $fileName,
        'id_sumberdana'   => $request->id_sumberdana
    ]);

    return redirect('transaksi/pengeluaran/0')->with('success', 'Berhasil menambahkan data pemasukan!');
}

     /**
 * Fungsi untuk memproses tambah pemasukan
 * 
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
 */
    public function addPemasukan(Request $request)
    {
    // Validasi data form menggunakan validator
    $validator = Validator::make($request->all(), [
        'jenis_id' => 'required|integer',
        'status' => 'required|integer',
        'nominal' => 'required|integer',
        'catatan' => 'required',
        'file' => 'required|mimes:jpg,png,jpeg,pdf|max:2048',
        'id_sumberdana' => 'required'
    ]);

    // Jika validasi gagal, kembali ke halaman pemasukan dengan error
    if ($validator->fails()) {
        return redirect('/pemasukan')
            ->withErrors($validator)
            ->withInput();
    }

    // Membuat nama file dari timestamp saat upload
    $fileName = time() . '.' . $request->file->extension();

    // Upload ke dalam folder public/uploads
    $request->file->move(public_path('uploads'), $fileName);

    // Membuat ID pemasukan dengan prefix MSK
    $transaksi_id = Helper::IDGenerator(new Transaksi, 'transaksi_id', 5, 'MSK');

    // Mengambil ID user yang login
    $uid = $request->user()->id;

    // Proses input data ke tabel transaksi
    Transaksi::create([
        'transaksi_id'    => $transaksi_id,
        'uid'             => $uid,
        'tipe_transaksi'  => 1, // 1 = Pemasukan
        'status'          => $request->status,
        'jenis_id'        => $request->jenis_id,
        'nominal'         => $request->nominal,
        'catatan'         => $request->catatan,
        'file'            => $fileName,
        'id_sumberdana'   => $request->id_sumberdana
    ]);

    return redirect('/pemasukan')->with('success', 'Berhasil menambahkan data pemasukan!');
}

public function index($tipe)
{
    // Ternary operator seperti if else
    $tipeHalaman = ($tipe == 1) ? 'pemasukan' : 'pengeluaran';

    $jenis = JenisTransaksi::all();
    $sumber = SumberDana::all();
    $id = Auth::id();

    $data = Transaksi::join('jenis_transaksi', 'jenis_transaksi.id', '=', 'transaksi.jenis_id')
        ->join('sumber_dana', 'sumber_dana.id', '=', 'transaksi.id_sumberdana')
        ->where('uid', $id)
        ->where('tipe_transaksi', $tipe)
        ->orderBy('created_at', 'desc')
        ->get([
            'transaksi.*',
            'sumber_dana.sumber',
            'sumber_dana.logo',
            'jenis_transaksi.nama_transaksi'
        ]);

    return view($tipeHalaman, [
        'jenises' => $jenis,
        'pemasukan' => $data,
        'pengeluaran' => $data,
        'sumberdanas' => $sumber
    ]);
}

/**
 * Fungsi untuk memanggil view edit-pemasukan
 *
 * @param mixed $id
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
 */
public function editPemasukanPage($id)
{
    $jenis = JenisTransaksi::all();
    $transaksi = Transaksi::find($id);
    $sumber = SumberDana::all();

    if (!$transaksi) {
        return redirect('/transaksi/pemasukan/1')
            ->withErrors('Data tidak ditemukan!');
    }

    return view('edit-pemasukan', [
        'jenises'   => $jenis,
        'transaksi' => $transaksi,
        'sumberdanas' => $sumber
    ]);
}
/**
 * Proses edit pemasukan
 *
 * @param \Illuminate\Http\Request $request
 * @param mixed $id
 * @return \Illuminate\Http\RedirectResponse|mixed
 */
public function editPemasukan(Request $request, $id)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'jenis_id'     => 'required|integer',
        'status'       => 'required|integer',
        'nominal'      => 'required|integer',
        'catatan'      => 'required',
        'fileDokumen'  => 'sometimes|mimes:jpg,png,jpeg,pdf,docx|max:2048',
        'id_sumberdana' => 'required'
    ]);

    if ($validator->fails()) {
        return redirect('/pemasukan/edit/' . $id)
            ->withInput()
            ->withErrors($validator);
    }

    // Ambil data transaksi berdasarkan ID
    $transaksi = Transaksi::find($id);


    if ($transaksi) {
        // Update data transaksi
        $transaksi->status    = $request->status;
        $transaksi->jenis_id  = $request->jenis_id;
        $transaksi->nominal   = $request->nominal;
        $transaksi->catatan   = $request->catatan;
        $transaksi->id_sumberdana = $request->id_sumberdana;

        // Jika ada file baru diupload
        if ($request->hasFile('fileDokumen')) {
            // Hapus file lama jika ada
            if ($transaksi->file) {
                \Illuminate\Support\Facades\File::delete(public_path('uploads/' . $transaksi->file));
            }

            // Upload file baru
            $fileName = time() . '.' . $request->file('fileDokumen')->extension();
            $request->file('fileDokumen')->move(public_path('uploads'), $fileName);
            $transaksi->file = $fileName;
        }

        $transaksi->save();

        return redirect('/transaksi/pemasukan/1')
            ->with('success', 'Data pemasukan berhasil diperbarui.');
    }

    return redirect('/pemasukan/edit/' . $id)
        ->withInput()
        ->withErrors('Data tidak ditemukan!');
}
/**
 * Proses delete data pemasukan
 *
 * @param \Illuminate\Http\Request $request
 * @param mixed $id
 * @return \Illuminate\Http\RedirectResponse|mixed
 */
public function deletePemasukan(Request $request, $id)
{
    $transaksi = Transaksi::find($id);

    if ($transaksi) {
        // Hapus file jika ada
        if ($transaksi->file) {
            \Illuminate\Support\Facades\File::delete(public_path('uploads/' . $transaksi->file));
        }

        // Hapus data dari database
        $transaksi->delete();

        return redirect('/transaksi/pemasukan/1')
            ->with('success', 'Transaksi berhasil dihapus.');
    }

    return redirect('/transaksi/pemasukan/1')
        ->with('error', 'Transaksi tidak ditemukan.');
}
public function cetakPdfPemasukan()
{
    $id = Auth::id();

    // Ambil data transaksi pemasukan user
    $transaksi = Transaksi::join('jenis_transaksi', 'jenis_transaksi.id', '=', 'transaksi.jenis_id')
        ->where('uid', $id)
        ->where('tipe_transaksi', 1)
        ->orderBy('created_at', 'desc')
        ->get([
            'transaksi.*',
            'jenis_transaksi.nama_transaksi'
        ]);

    // Hitung total nominal pemasukan
    $total = Transaksi::where('uid', $id)
        ->where('tipe_transaksi', 1)
        ->sum('nominal');

    // Buat PDF dari view 'halamanpdf'
    $pdf = PDF::loadView('halamanpdf', [
        'datas' => $transaksi,
        'title' => 'Pemasukan',
        'total' => $total
    ]);

    return $pdf->download('pemasukan.pdf');
}

 /**
 * Fungsi untuk memanggil view edit-pemasukan
 *
 * @param mixed $id
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
 */
public function editPengeluaranPage($id)
{
    $jenis = JenisTransaksi::all();
    $transaksi = Transaksi::find($id);
    $sumber = SumberDana::all();

    if (!$transaksi) {
        return redirect('/transaksi/pengeluaran/0')
            ->withErrors('Data tidak ditemukan!');
    }

    return view('edit-pengeluaran', [
        'jenises'   => $jenis,
        'transaksi' => $transaksi,
        'sumberdanas' => $sumber
    ]);
}
/**
 * Proses edit pemasukan
 *
 * @param \Illuminate\Http\Request $request
 * @param mixed $id
 * @return \Illuminate\Http\RedirectResponse|mixed
 */
public function editPengeluaran(Request $request, $id)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'jenis_id'     => 'required|integer',
        'status'       => 'required|integer',
        'nominal'      => 'required|integer',
        'catatan'      => 'required',
        'fileDokumen'  => 'sometimes|mimes:jpg,png,jpeg,pdf,docx|max:2048',
        'id_sumberdana' => 'required'
    ]);

    if ($validator->fails()) {
        return redirect('/pengeluaran/edit/' . $id)
            ->withInput()
            ->withErrors($validator);
    }

    // Ambil data transaksi berdasarkan ID
    $transaksi = Transaksi::find($id);

    if ($transaksi) {
        // Update data transaksi
        $transaksi->status    = $request->status;
        $transaksi->jenis_id  = $request->jenis_id;
        $transaksi->nominal   = $request->nominal;
        $transaksi->catatan   = $request->catatan;

        // Jika ada file baru diupload
        if ($request->hasFile('fileDokumen')) {
            // Hapus file lama jika ada
            if ($transaksi->file) {
                \Illuminate\Support\Facades\File::delete(public_path('uploads/' . $transaksi->file));
            }

            // Upload file baru
            $fileName = time() . '.' . $request->file('fileDokumen')->extension();
            $request->file('fileDokumen')->move(public_path('uploads'), $fileName);
            $transaksi->file = $fileName;
        }

        $transaksi->save();

        return redirect('/transaksi/pengeluaran/0')
            ->with('success', 'Data pemasukan berhasil diperbarui.');
    }

    return redirect('/pengeluaran/edit/' . $id)
        ->withInput()
        ->withErrors('Data tidak ditemukan!');
    }
}
