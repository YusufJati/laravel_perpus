<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;




class DashboardController extends Controller
{
    public function index(Request $request)
{
    $kategori = Kategori::all();
    $penerbit = $request->input('penerbit');
    $keyword = $request->input('keyword');
    $kategoryQuery = $request->input('kategori');
    $bukuQuery = Buku::query();

   
    // if ($judul || $kategoryQuery) {
    //     $bukuQuery = Buku::query();

    //     if ($judul ) {
    //         $bukuQuery->where('judul', 'like', '%' . $judul . '%');
    //     }
    
    if ($keyword ||$penerbit || $kategoryQuery) {
        

        if ($keyword) {
            $bukuQuery->where(function ($query) use ($keyword) {
                $query->where('judul', 'like', '%' . $keyword . '%')
                      ->orWhere('pengarang', 'like', '%' . $keyword . '%')
                      ->orWhere('penerbit', 'like', '%' . $keyword . '%')
                      ->orWhere('tahun', 'like', '%' . $keyword . '%')
                      ->orWhere('isbn', 'like', '%' . $keyword . '%');
            });
        }

        if ($kategoryQuery) {
            $bukuQuery->where('idkategori', $kategoryQuery);
        }

        $buku = $bukuQuery->get();
    } else {
        $buku = Buku::all();
    }

    return view('dashboard', ['buku' => $buku, 'kategori' => $kategori, 'penerbit' => $penerbit]);
}

}
