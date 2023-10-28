<?php

namespace App\Http\Controllers;

use App\Models\Detail_transaksi;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    // public function index(Detail_transaksi $detail_transaksi){
    //     $detail_transaksi -> load('get');
    //     return view('riwayat', ['detail_transaksi' => $detail_transaksi]);
    // }


    public function index(){
        $transaksi = Detail_transaksi::all();
        return view("dashboard.anggota.riwayat",[
            'transaksi' => $transaksi]);
    }

}
