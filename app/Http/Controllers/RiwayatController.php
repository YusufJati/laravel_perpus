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
        $transaksi = Detail_transaksi::where('tgl_kembali','!=','0000-00-00')->get();
        $transaksi->load('getBuku');
        
   

        $peminjaman = Detail_transaksi::whereNull('tgl_kembali')->get();
        $peminjaman->load('getBuku');

        $terlambat = Peminjaman::join('detail_transaksi','peminjaman.idtransaksi','=','detail_transaksi.idtransaksi')->join('buku','detail_transaksi.idbuku','=','buku.idbuku')->select('peminjaman.*','detail_transaksi.*','buku.*')->whereRaw('DATEDIFF(detail_transaksi.tgl_kembali, peminjaman.tgl_pinjam) > 14')->get();



        return view("riwayat",[
            'transaksi' => $transaksi,
            'peminjaman'=> $peminjaman,
            'terlambat' => $terlambat
        ]);
    }



}
