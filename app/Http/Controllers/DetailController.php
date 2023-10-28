<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{
    public function index(Buku $buku){
        $buku -> load('getKomentarBuku');
        return view('detail', ['buku' => $buku]);
    }
}
 