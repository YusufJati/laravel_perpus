<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $kategori = Kategori::all();
        $penerbit = $request->input('penerbit');
        $keyword = $request->input('keyword');
        $kategoryQuery = $request->input('kategori');
        $bukuQuery = Buku::query();
        
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

        return view('home',['buku' => $buku, 'kategori' => $kategori, 'penerbit' => $penerbit]);
    }
}
