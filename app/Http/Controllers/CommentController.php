<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Komentar_buku;

class CommentController extends Controller
{
    public function index()
    {
        $komentar = Komentar_buku::all();
        return view('Komentar_buku.index', ['komentar' => $komentar]);
    }

    public function store(Request $request, $idbuku)
    {
        $request->validate([
            'komentar' => 'required',
        ]);

        $anggota = Auth::user();

        Komentar_buku::create([
            'noktp' => $anggota->noktp,
            'idbuku' => $idbuku,
            'komentar' => $request->komentar,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil disimpan.');
    }




}
?>