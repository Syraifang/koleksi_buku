<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = [
        'judul', 
        'penulis', 
        'kategori_id', 
        'tahun_terbit'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
