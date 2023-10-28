<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $primaryKey = 'idbuku';

    public function getKomentarBuku() {
        return $this->hasMany(Komentar_buku::class, 'idbuku', 'idbuku');
    }

    public function getKategoriBuku(){
        return $this->hasOne(Kategori::class, 'idkategori', 'idkategori');
    }

    public function getRatingBuku(){
        return $this->hasOne(Rating_buku::class, 'idbuku', 'idbuku');
    }

    
}
