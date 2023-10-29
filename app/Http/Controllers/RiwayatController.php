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
        $noktp = Auth::user()->noktp;

        $transaksi = Peminjaman::join('detail_transaksi','peminjaman.idtransaksi','=','detail_transaksi.idtransaksi')->join('buku','detail_transaksi.idbuku','=','buku.idbuku')->select('peminjaman.*','detail_transaksi.*','buku.*')->where('tgl_kembali','!=','0000-00-00')->where('noktp',$noktp)->get();


        $peminjaman = Peminjaman::join('detail_transaksi','peminjaman.idtransaksi','=','detail_transaksi.idtransaksi')->join('buku','detail_transaksi.idbuku','=','buku.idbuku')->select('peminjaman.*','detail_transaksi.*','buku.*')->where('noktp',$noktp)->whereNull('tgl_kembali')->get();


        $terlambat = Peminjaman::join('detail_transaksi','peminjaman.idtransaksi','=','detail_transaksi.idtransaksi')->join('buku','detail_transaksi.idbuku','=','buku.idbuku')->select('peminjaman.*','detail_transaksi.*','buku.*')->whereRaw('DATEDIFF(detail_transaksi.tgl_kembali, peminjaman.tgl_pinjam) > 14')->where('noktp',$noktp)->get();

        return view("riwayat",[
            'transaksi' => $transaksi,
            'peminjaman'=> $peminjaman,
            'terlambat' => $terlambat
        ]);
    }
}
