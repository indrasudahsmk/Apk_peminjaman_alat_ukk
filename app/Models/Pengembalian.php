<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $fillable = [
        'peminjaman_id',
        'jumlah',
        'tanggal_pengembalian',
        'denda'
    ];

    public function peminjaman(){
        return $this->belongsTo(Peminjaman::class);
    }
}
