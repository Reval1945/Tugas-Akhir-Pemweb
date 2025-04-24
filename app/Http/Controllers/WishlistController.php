<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\WishlistImport;

class WishlistController extends Controller
{
    /**
     * Menampilkan data wishlist
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Mengambil seluruh data wishlist dari database
        $wishlist = Wishlist::all();

        // Menampilkan view dengan data wishlist
        return view('wishlist', ['datas' => $wishlist]);
    }

    /**
     * Mengupload file Excel dan mengimport data ke database
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request)
    {
        // Validasi file yang diupload
        $request->validate([
            'fileExcel' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        // Mengimpor data dari file Excel
        Excel::import(new WishlistImport, $request->file('fileExcel'));

        // Kembali ke halaman sebelumnya setelah proses berhasil
        return back()->with('success', 'Data Wishlist berhasil diimport!');
    }
}
