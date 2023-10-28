<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Komentar_buku;

class CommentController extends Controller
{
    // Menampilkan semua komentar
    public function index()
    {
        $komentar = Komentar_buku::all();
        return view('Komentar_buku.index', ['komentar' => $komentar]);
    }

    // Menyimpan komentar baru
    public function store(Request $request)
    {
        $this->middleware('auth');

        // Validasi data input
        $request->validate([
            'noktp' => 'required',
            'idbuku' => 'required',
            'komentar' => 'required',
        ]);

        // Ambil anggota yang saat ini login
        $anggota = Auth::user();

        // Simpan komentar ke database
        Komentar_buku::create([
            'noktp' => $request->noktp,
            'idbuku' => $request->idbuku,
            'komentar' => $request->komentar,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil disimpan.');
    }

}
?>