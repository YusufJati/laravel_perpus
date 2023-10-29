<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating_buku extends Model
{
    use HasFactory;
    protected $table = 'rating_buku';

    public $timestamps = false;
    protected $fillable = [
        'noktp', 
        'idbuku',
        'skor_rating',
        'tgl_rating'
    ];
}
