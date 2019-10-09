<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operator;
use DB;
use Redirect;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //Menampilkan Halaman Admin
    public function index()
    {
        
        return view('admindash');
    }
    //Menampilkan List Operator
    public function opindex()
    {
        $operator = DB::table('operators')->get();
        $gedung = DB::table('gedungs')->get();
        
        return view('admin.indexoperator')->with('operator',$operator)->with('gedung',$gedung);
    }
    //Menampilkan Info Lengkap Operator
    public function infooperator($id)
    {   
        $operator = DB::table('operators')->where('id',$id)->get();
        $gedung = DB::table('gedungs')->where('Operator_Id',$id)->get();
        return view('admin.infooperator')->with('gedung',$gedung)->with('operator',$operator);
    }
    //Menampilkan Halaman Daftar Operator
    public function daftar()
    {
        return view('admin.buatoperator');
    }
    //Daftar Operator
    public function store(Request $request)
    {   

        $w = $request->password;
        $e = $request->password2;
        $find = DB::table('operators')->where('Email',$request->email)->get();
     
        if($w == $e && count($find) == 0){
            DB::table('operators')->insert([
                'Name_Operator' => $request->nama,
                'Email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->action(
                'GedungController@create',['id' => $request->email]
            )->with('success','Berhasil Mendaftarkan Account Operator')->with('email',$request->email);
        }         
        elseif(count($find) != 0)
            return redirect('/daftarop')->with('error','Email Yang Anda Masukan Sudah Terdaftar');  
        elseif($w != $e){
            return redirect('/daftarop')->with('error','Confirm Password Tidak Sesuai Dengan Password');
        }
    }
    //Menampilkan Data Operator
    public function edit($id)
    {
        $operator = DB::table('operators')->where('id',$id)->get();
        $gedung = DB::table('gedungs')->where('id',$id)->get();
        return view('admin.editoperator')->with('gedung',$gedung)->with('operator',$operator);

    }
    //Hapus Data Gedung Dan Operator
    public function hapus(Request $request)
    {
        $a = DB::table('slot_parkirs')->where('Gedung_Id',$request->id)->get();
        $d = count($a);
        if(count($a) == 0){
            DB::table('operators')->where('id',$request->id)->delete();
            DB::table('gedungs')->where('Operator_Id',$request->id)->delete();
        
            return redirect('/operatorinfo')->with('success','Data Gedung Dan Operator Berhasil Dihapus');
        }
        else           
            return redirect('/operatorinfo')->with('success','Data Operator Berhasil Dihapus');
    }
    //Mengedit Data Operator
    public function editaccount(Request $request){
        $find = DB::table('operators')->where('Email',$request->email)->get();

        if(count($find) == 0){
            DB::table('operators')->where('id',$request->id)->update([
                'Name_Operator' => $request->nama,
                'Email' => $request->email,
            ]); 
            return redirect('/operatorinfo')->with('success','Berhasil Mengedit Data Operator');
        }
        else if($request->email == $request->email1){
            DB::table('operators')->where('id',$request->id)->update([
                'Name_Operator' => $request->nama,
                'Email' => $request->email,
            ]); 
            return redirect('/operatorinfo')->with('success','Berhasil Mengedit Data Operator');
        }
        else
             return redirect()->action(
                'AdminController@infooperator',['id' => $request->id]
            )->with('error','Email Yang Dimasukan Sudah Terdaftar');
        
        

    }
    //Mengganti Password Operator
    public function ganti(Request $request)
    {
        $ide = $request->id;
        $passw = Hash::make($request->password);
        if($request->password == $request->password2){         
            if (Hash::check($request->oldpassword, $request->pass)) {
                DB::table('operators')->where('id',$request->id)->update([
                    'Email' => $request->email,
                    'Password'=>$passw,

                ]);
                return redirect()->action(
                    'AdminController@edit',['id' => $ide]
                )->with('success','Password Berhasil Diganti');
            }
            else{
                return redirect()->action(
                    'AdminController@edit',['id' => $ide]
                )->with('error','Password Lama Salah');
                
            }

                
        }
      
        else{
            return redirect()->action(
                'AdminController@edit',['id' => $ide]
            )->with('error','Password Dan Confirm Password Tidak Sama');
        }

    }
}
