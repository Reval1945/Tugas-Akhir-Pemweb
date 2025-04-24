<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberDana extends Model
{
    use HasFactory;

    protected $table = 'sumber_dana'; // jika nama tabel tidak mengikuti plural bawaan Laravel

    protected $fillable = [
        'sumber',
        'logo',
    ];
}
