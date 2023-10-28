<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar_buku extends Model
{
    use HasFactory;
    protected $table = 'komentar_buku';

    public function getAnggotaKomentar(){
        return $this->hasOne(Anggota::class, 'noktp', 'noktp');
    }
}
