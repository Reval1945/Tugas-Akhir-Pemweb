<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'transaksi_id',
        'uid',
        'tipe_transaksi',
        'status',
        'jenis_id',
        'nominal',
        'catatan',
        'file',
        'id_sumberdana'
    ];
    
}
