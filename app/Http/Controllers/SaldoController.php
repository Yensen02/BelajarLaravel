<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class SaldoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    public function info()
    {
        $user = DB::table('users')->get();
        return view('saldo.info')->with('user',$user);
    }
    public function infouser($id)
    {
        $usa = DB::table('users')->where('id',$id)->get();
        $mobils = DB::table('mobils')->where('user_id',$id)->get();
        return view('saldo.infouser')->with('mobils',$mobils)->with('usa',$usa);
    }
    public function cari (Request $request)
    {       		
		 $cari = $request->cari;
         $user = DB::table('users')->where('name','like',"%".$cari."%")->get();   
         return view('saldo.info')->with('user',$user);
    }
    public function tambah(Request $request)
    {
        $saldo = $request->saldo;
        $saldos = $request->saldos;
        $saldoss = 0;
        $saldoss = $saldo + $saldos;
        	
	    DB::table('users')->where('id',$request->id)->update([
            'saldo' => $saldoss,
        ]);	
        DB::table('history_saldos')->insert([
            'user_id' => $request->id,
            'operator_id' => $request->opid,
            'jumlah' => $saldo,
        ]);
        return redirect('/opprofile')->with('success','Saldo Berhasil Ditambahkan');
       
    }

}
