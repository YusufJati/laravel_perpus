<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_transaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';
    protected $primaryKey = 'idtransaki, idbuku';

    public function getBuku() {
        return $this->hasMany(Buku::class, 'idbuku', 'idbuku');
    }

    public function getPeminjaman() {
        return $this->belongsTo(Peminjaman::class, 'idtransaksi', 'idtransaksi');
    }
}
