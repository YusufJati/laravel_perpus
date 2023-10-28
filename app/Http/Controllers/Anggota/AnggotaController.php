<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    function create(Request $request){
        //validate
        $request->validate([
            'noktp'=>'required|unique:anggota,noktp',
            'nama'=>'required',
            'email'=>'required|email|unique:anggota,email',
            //'password'=>'required|min:5|max:30',
            $hashedPassword = Hash::make($request->input('password')),
            'alamat'=>'required',
            'kota'=>'required',
            'no_telp'=>'required',
            'file_ktp'=>'required'
        ]);

        $anggota = new Anggota();
        $anggota->noktp = $request->noktp;
        $anggota->nama = $request->nama;
        $anggota->email = $request->email;
        $anggota->password = Hash::make($request->password);
        $anggota->alamat = $request->alamat;
        $anggota->kota = $request->kota;
        $anggota->no_telp = $request->no_telp;
        $anggota->file_ktp = $request->file_ktp;
        $save = $anggota->save();

        if( $save ){
            return redirect()->back()->with('success','You are now registered successfully as Anggota');
        }else{
            return redirect()->back()->with('fail','Something went Wrong, failed to register');
        }
    }

    function check(Request $request){
        //validate
        
        $request->validate([
            'email'=>'required|email|exists:anggota,email',
            'password'=>'required|min:5|max:30',
        ],[
            'email.exists'=>'This email is not exists in anggota table'
        ]);

        $creds = $request->only('email','password');

        if( Auth::guard('anggota')->attempt($creds) ){
            Log::info('Pengguna dengan email ' . $request->input('email') . ' berhasil masuk.');
            return redirect('/');
        }else{
            Log::info('Pengguna dengan email ' . $request->input('email') . ' gagal masuk.');
            return redirect()->route('anggota.login')->with('fail','Incorrect Credentials');
        }
    }

    function riwayat()
    {
        return view('riwayat');
    }
}
