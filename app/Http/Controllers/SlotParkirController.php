<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SlotParkirController extends Controller
{    


    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function custom()
    {
        $gedung = DB::table('gedungs')->get();
        return view('gedung.custom')->with('gedung',$gedung);
    }
    public function show (Request $request)
    {
     
        return redirect()->action(
            'SlotParkirController@index',['id' => $request->gid]
        );
    }
    public function index($id)
    {
        $gedung = DB::table('gedungs')->where('id',$id)->get();
        $lantai = DB::table('lantais')->where('Gedung_Id',$id)->get();
        $slot = DB::table('slot_parkirs')->where('Gedung_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Gedung_Id',$id)->orderby('id','desc')->take(10)->get();
        return view('slot.adminslot')->with('gedung',$gedung)->with('slot',$slot)->with('slot1',$slot1)->with('lantai',$lantai);
    }
    public function index1($id)
    {
        $slot= DB::table('slot_parkirs')->where('id',$id)->get();
        foreach($slot as $s1)
        {
            $gid = $s1->Gedung_Id;
        }
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        $slot1 = DB::table('slot_parkirs')->get();
        return view('slot.adminslot1')->with('gedung',$gedung)->with('slot1',$slot1)->with('slot',$slot);
    }
    //Tambah 10 Slot Custom
    public function tambah10($id)
    {
        $slot = DB::table('lantais')->where('id',$id)->get();
        foreach($slot as $s)
        {
            $gid = $s->Gedung_Id;
        }
        for($i=0;$i<10;$i++){
            DB::table('slot_parkirs')->insert([
                'Gedung_Id' => $gid,
                'Lantai_Id' => $id,
            ]);
        }
        
        return redirect()->action(
            'LantaiController@index',['id' => $id]
        )->with('success','Berhasil Menambahkan Slot Parkir');

    }
    //tambah lantai
    public function tambahlantai(Request $request)
    {
        $jumlahlantai= 0 ;
        $jumlahlantai = $request->jumlah + 1;
        if (strlen($request->namalantai) < 3)
        {
            DB::table('lantais')->insert([
                'Gedung_Id' => $request->gid,
                'Nama_Lantai'=> $request->namalantai,
                
    
            ]);
            DB::table('gedungs')->where('id',$request->gid)->update([
                'Jumlah_Lantai' =>$jumlahlantai,
            ]);
                
            return redirect()->action(  
                'SlotParkirController@index',['id' => $request->gid]
            )->with('success','Berhasil Menambahkan Lantai');
        }
        else{
            return redirect()->action(  
                'SlotParkirController@index',['id' => $request->gid]
            )->with('error','Nama Lantai Harus Kurang Dari 2 Huruf');
        }

    } 
        
    //Menghapus Lantai Admin
    public function deletelantai(Request $request)
    {
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$request->lid)->get();
        if(count($slot) == 0){
            DB::table('gedungs')->where('id',$request->gid)->update([
                'Jumlah_Lantai' => $jumlahlantai,
            ]);
            //$slot = DB::table('slot_parkirs')->where('id',$request->)
            DB::table('lantais')->where('id',$request->lid)->delete();            
            return redirect()->action(
                    'SlotParkirController@index',['id' => $request->gid]
                )->with('success','Berhasil Menghapus Lantai');
        }
        else
            return redirect()->action(
            'SlotParkirController@index',['id' => $request->gid]
            )->with('error','TIdak Bisa Menghapus Lantai');
    }
    //tentukan layout parkir
    //public function tambah (Request $request)
   // {
    //    $total = $request->in;
    //    for($i=0;$i<$total;$i++){
    //       DB::table('slot_parkirs')->insert([
    //          'Gedung_Id' => $request->gid,
    //         'Lantai_Id' => 1,
    //        ]);
    //    }
    //    DB::table('gedungs')->where('id',$request->gid)->update([
    //        'Jumlah_Slot' => 0,
            
    //    ]);
    //    return redirect()->action(  
    //        'SlotParkirController@index',['id' => $request->gid]
    //    )->with('success','Berhasil Menambahkan Layout');
    //}

    //Menghapus Slot Parkir 10 Untuk Admin
    public function delete(Request $request)
    {
        $jumlah=0;
        $jumlah = $request->jumlah-$request->a; 
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$request->lid)->get();
        if(count($slot) == 10)
            $jumlah = -1;
            
        if($request->a1 == 0){
            DB::table('lantais')->where('id',$request->lid)->update([
                'Jumlah_Slot' => $jumlah,              
            ]);
    
            //Query Mengambil Data 10 Paling Bawah Untuk Dihapus
            DB::table('slot_parkirs')->where('Gedung_Id',$request->gid)->orderBY('id','desc')->take(10)->delete();
                return redirect()->action(
                    'LantaiController@index',['id' => $request->lid]
                )->with('success','Berhasil Menghapus Slot');

        }
        else
        return redirect()->action(
            'LantaiController@index',['id' => $request->lid]
        )->with('error','Tidak Bisa Menghapus Layout');

    
        

    }
    //Edit/Tambah Slot Parkir
    public function store(Request $request)
    {
        if(strlen($request->nama) == 0)
        {    
            return redirect()->action(
            'LantaiController@slotindex',['id' => $request->lid]
            )->with('error','Nama Slot Tidak Boleh Kosong');

        }
        else if(strlen($request->nama) < 5)
        {
            DB::table('slot_parkirs')->where('id',$request->id)->update([
                'Nama_Slot' => $request->nama,
                'Status_Slot' => 2,
            ]);	
            $jumlah = 0;
            $jumlahslot = $request->jslot;      
            $jumlah = $jumlahslot + 1;
            if($request->status == 0){
                DB::table('lantais')->where('id',$request->lid)->update([
                    'Jumlah_Slot' => $jumlah,
                    ]);
            }           
            return redirect()->action(
                'LantaiController@index',['id' => $request->lid]
            )->with('success','Berhasil Menambah Slot');

        }
        else{
            return redirect()->action(
                'SlotParkirController@index',['id' => $request->gid]
            )->with('error','Untuk Nama Slot Max 4');
        }
        
        
    }
    //Delete Slot
    public function store1(Request $request)
    {
        DB::table('slot_parkirs')->where('id',$request->id)->update([
            'Nama_Slot' => $request->nama,
            'Status_Slot' => 0,
        ]);	
        $jumlah = 0;
        $jumlahslot = $request->jslot;      
        $jumlah = $jumlahslot - 1;
        DB::table('lantais')->where('id',$request->lid)->update([
            'Jumlah_Slot' => $jumlah,
        ]);
        return redirect()->action(
            'LantaiController@index',['id' => $request->lid]
        )->with('success','Berhasil Menambah Slot');
    }

    public function fulldelete (Request $request)
    {
        
        if($request->b1 == 0){
            DB::table('slot_parkirs')->where('Lantai_Id',$request->lid)->delete();
        
            DB::table('lantais')->where('id',$request->lid)->update([
                'Jumlah_Slot' => -1,
            ]);
            return redirect()->action(
                'LantaiController@index',['id' => $request->lid]
            )->with('success','Berhasil Menghapus Layout');
        }
        else
        return redirect()->action(
            'LantaiController@index',['id' => $request->lid])->with('error','Tidak Bisa Menghapus Layout');
    }
    
    
  
}
