<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table = 'pemasukan';
    protected $fillable = ['tanggal', 'jenis_id', 'nominal', 'keterangan'];

    public function jenis()
    {
        return $this->belongsTo(JenisTransaksi::class, 'jenis_id');
    }
}

