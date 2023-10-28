<?php

namespace App\Http\Controllers;

use App\Models\Detail_transaksi;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    // public function index(Detail_transaksi $detail_transaksi){
    //     $detail_transaksi -> load('get');
    //     return view('riwayat', ['detail_transaksi' => $detail_transaksi]);
    // }


    public function index()
    {
        // Ambil noktp dari pengguna yang sudah login
        $noktp = Auth::user()->noktp;
        
        // Lakukan query untuk mengambil peminjaman beserta detail transaksinya
        $peminjaman = Peminjaman::where('noktp', $noktp)->with('detailTransaksis')->get();

        return view('riwayat', ['peminjaman' => $peminjaman]);
    }



}
