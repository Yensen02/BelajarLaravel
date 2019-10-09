<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class LantaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //Menampilkan Halaman Utama
    public function index($id)
    {
        $lantai = DB::table('lantais')->where('id',$id)->get();
        
        foreach($lantai as $l)
        {
            $gid = $l->Gedung_Id;
        }
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        return view('lantai.lantai')->with('gedung',$gedung)->with('slot',$slot)->with('slot1',$slot1)->with('lantai',$lantai)->with('lantai1',$lantai1);
    }
    //Demo Tambah Lantai
    public function index1($id)
    {
        $lantai = DB::table('lantais')->where('id',$id)->get();
        
        foreach($lantai as $l)
        {
            $gid = $l->Gedung_Id;
        }
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        return view('lantai.lantaitest')->with('gedung',$gedung)->with('slot',$slot)->with('slot1',$slot1)->with('lantai',$lantai)->with('lantai1',$lantai1);
    }
    //Demo Delete Lantai
    public function index2($id)
    {
        $lantai = DB::table('lantais')->where('id',$id)->get();
        
        foreach($lantai as $l)
        {
            $gid = $l->Gedung_Id;
        }
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        return view('lantai.lantaidelete')->with('gedung',$gedung)->with('slot',$slot)->with('slot1',$slot1)->with('lantai',$lantai)->with('lantai1',$lantai1);
    }

    //tentukan layout parkir
    public function tambah (Request $request)
    {
        $total = $request->in;
        for($i=0;$i<$total;$i++){
            DB::table('slot_parkirs')->insert([
                'Gedung_Id' => $request->gid,
                'Lantai_Id' => $request->lid,
            ]);
        }
        DB::table('lantais')->where('id',$request->lid)->update([
            'Jumlah_Slot' => 0,
            
        ]); 
        return redirect()->action(  
            'LantaiController@index',['id' => $request->lid]
        )->with('success','Berhasil Menambahkan Layout');
    }
    //Menentukan Slot Parkir
    public function slotindex($id)
    {
        $infoslot = DB::table('slot_parkirs')->where('id',$id)->get();
        foreach ($infoslot as $s){
            $lid = $s->Lantai_Id;
        }
        $slot1= DB::table('slot_parkirs')->where('Lantai_Id',$lid)->get();
        $lantai = DB::table('lantais')->where('id',$lid)->get();
        return view('lantai.slotlantai')->with('infoslot',$infoslot)->with('slot1',$slot1)->with('lantai',$lantai);
    }
    //testing delete
    public function deletetest(Request $request)
    {
        
        $g = $request->knk;
        $d = count($g);   
        $total = 0 ;
        $total = $request->jl - $d;
        
        for($i=0;$i<$d;$i++){
            
            DB::table('slot_parkirs')->where('id',$g[$i])->update([
                'Status_Slot' => 0,
                'Nama_Slot' =>  $request->d, 
            ]);
        }
        DB::table('lantais')->where('id',$request->lid)->update([
                'Jumlah_Slot' => $total,
        ]);     
        
        return redirect()->action(
            'LantaiController@index2',['id' => $request->lid]
            )->with('success','Berhasil Menghapus');
    }

    //testing
    public function tambahtest(Request $request)
    {
        $g = $request->knk;
        $d = count($g);        
        $r = $request->range;
        $n = $request->namaslot;
        $total = 0 ;
        $total1 = 0;
   
        if(strlen($r) == 0 )
        {    
            return redirect()->action(
            'LantaiController@index1',['id' => $request->lid]
            )->with('error','Range Harus Angka');

        }
    
        else if(strlen($request->namaslot) == 1)
        {   
            $total1= $d+$r;
            if($total1 > 1000)
            {
                return redirect()->action(
                    'LantaiController@index1',['id' => $request->lid]
                    )->with('error','Range Terlalu Tinggi');
            }
            else{
                for($i=0;$i<$d;$i++){
                    $total = $r + $i;
                    $der = $n.$total;
        
                    DB::table('slot_parkirs')->where('id',$g[$i])->update([
                        'Status_Slot' => 2,
                        'Nama_Slot' => $der,
                    ]);
                    $total = 0 ;
                }
                $total = $request->jl + $d;
                DB::table('lantais')->where('id',$request->lid)->update([
                        'Jumlah_Slot' => $total,
                ]);
                
                return redirect()->action(
                    'LantaiController@index1',['id' => $request->lid]
                    )->with('success','Berhasil');
    
            }
        }
        else{         
            return redirect()->action(
                'LantaiController@index1',['id' => $request->lid]
                )->with('error','Panjang Nama Slot Tidak Boleh Lebih Dari 1');
            }      
    }

}   

