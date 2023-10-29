<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Rating_buku;

class RatingController extends Controller
{
    public function show($idbuku) {
        $averageRating = Rating_buku::where('idbuku', $idbuku)->avg('skor_rating');
        $buku = Buku::find($idbuku);
    
        return view('buku.show', compact('buku', 'averageRating'));
    }

    public function store(Request $request, $idbuku) {
        $request->validate([
            'rating' => 'required|numeric|between:1,10', // Pastikan peringkat berada dalam rentang 1 hingga 10
        ]);

        $anggota = Auth::user();
        $currentDate = Carbon::today();

        $existingRating = Rating_buku::where('noktp', $anggota->noktp)
            ->where('idbuku', $idbuku)
            ->first();

        if ($existingRating) {
            return redirect()->back()->with('success', 'Anda sudah memberi peringkat untuk buku ini dengan peringkat ' . $existingRating->skor_rating);
        } else {
            Rating_buku::create([
                'noktp' => $anggota->noktp,
                'idbuku' => $idbuku,
                'skor_rating' => $request->rating,
                'tgl_rating' => $currentDate,
            ]);

            return redirect()->back()->with('success', 'Peringkat berhasil disimpan.');
        }
    }

    public function calculateAverageRating($idbuku) {
        $averageRating = Rating_buku::where('idbuku', $idbuku)->avg('skor_rating');
        return $averageRating;
    }
    
}
