<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman'; 
    protected $primaryKey = 'idtransaksi';

    protected $fillable = [
        'idtransaksi',
        'noktp',
        'tgl_pinjam',
        'idpetugas',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'noktp', 'noktp');
    }

    public function detailTransaksis() {
        return $this->hasMany(Detail_transaksi::class, 'idtransaksi', 'idtransaksi');
    }
}
