<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = [
        'name',
        'deskripsi'
    ];

    public function alats(){
        return $this->hasMany(Alat::class);
    }
}
