<?php

namespace App\Http\Controllers;

use App\Models\SumberDana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SumberDanaController extends Controller
{
    //
    public function index()
    {
        $data = SumberDana::all();
        return view('sumberdana', ['datas' => $data]);
    }

    public function addSumber(Request $request)
    {
        // Validasi Data form menggunakan validator
        $validator = Validator::make($request->all(), [
            'sumber_dana' => 'required|string',
            'logo' => 'mimes:jpg,png,jpeg|max:2048'
        ]);

        // Jika Validasi gagal akan ke halaman pemasukan dengan mengirim error
        if ($validator->fails()) {
            return redirect('/sumberdana')
                ->withInput()
                ->withErrors($validator);
        }

        $fileName = '';
        if ($request->hasFile('logo')) {
            $fileName = time() . '.' . $request->file('logo')->extension();
            $request->file('logo')->move(public_path('uploads'), $fileName);
        }

        SumberDana::create([
            'sumber' => $request->sumber_dana,
            'logo' => $fileName
        ]);

        return redirect('/sumberdana');
    }
}
