<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Gedung;
use Auth;

class GedungController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function infogedung($id)
    {
        $gedung = Gedung::find($id);
        $slot = DB::table('slot_parkirs')->where('Gedung_Id',$id)->get();
            $opid=$gedung->Operator_Id;
        $user = DB::table('operators')->where('id',$opid)->get();
        return view('gedung.info')->with('gedung',$gedung)->with('slot',$slot)->with('user',$user);
    }
    public function create($id)
    {
        $profile = DB::table('operators')->where('email',$id)->get();
        if (count($profile) == 0)
            return redirect('/operatorinfo')->with('error','Tidak Bisa Mengakses Page Ini');
        else{
            foreach($profile as $pro)
            $idoperator = $pro->id;
        
            $operator = DB::table('gedungs')->where('id',$idoperator)->get();
            if (count($operator) == 0)
             return view('gedung.create')->with('idoperator',$idoperator);
            else 
             return redirect('/operatorinfo')->with('error','Account Ini Tidak Bisa Menambahkan Gedung');

        }
        
    }
    public function custom()
    {
        $op_id = auth()->user()->id;
        $gedung = DB::table()->where('Operator_Id',$op_id)->get();
        return view('gedung.custom');
    }
    public function gedung()
    {
        return view('gedung.test');
    }
    public function store(Request $request)
    {
        DB::table('gedungs')->insert([
            'Operator_id' => $request->opid,
            'Nama_Gedung' => $request->nama,
            'Alamat' => $request->alamat,
        ]);
        return redirect('/operatorinfo')->with('success','Data Gedung Berhasil Ditambah');        
    }
    public function edit($id)
    {
        $gedung = Gedung::find($id);
        $user = DB::table('operators')->get();
        return view('gedung.edit')->with('gedung',$gedung)->with('user',$user);$gedung = Gedung::find($id);
            
    }
    public function update(Request $request)
    {
        $op = DB::table('gedungs')->where('Operator_Id',$request->opid)->get();
        $od = $request->idope;
        $oc = $request->opid;

        if(count($op) == 0){
            DB::table('gedungs')->where('id',$request->id)->update([
                'Nama_Gedung' => $request->namagedung,
                'Alamat' => $request->alamat,
                'Operator_Id' => $od,
            ]);	
            return redirect('/operatorinfo')->with('success','Data Gedung Berhasil Diubah');
        }
        

    }
    public function simpan(Request $request)
    {
        $pe = $request->p;
        $px= 0;
        $px = $px + $pe;
        
        for($i=0;$i<$px;$i++){
            DB::table('slot_parkirs')->insert([
                'Gedung_Id' => $request->gid,
            ]);           
        }
        DB::table('gedungs')->where('id',$request->gid)->update([
            'Jumlah_Slot' => $request->jumlahslot,
        ]);	
        return redirect('/gedung/custom')->with('success','Layout Sudah Terpilih');       
    }
}
