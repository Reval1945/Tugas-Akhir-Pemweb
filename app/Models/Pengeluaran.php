<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';
    protected $fillable = ['tanggal', 'jenis_id', 'nominal', 'keterangan'];

    public function jenis()
    {
        return $this->belongsTo(JenisTransaksi::class, 'jenis_id');
    }
}
