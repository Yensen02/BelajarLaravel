<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class OperatorSlotController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    //Menampilkan Halaman Gedung Operator
    //Halaman http://localhost:8000/opslotoperator/layout
    public function index()
    {
        $id = auth()->user()->id;
        $gedung = DB::table('gedungs')->where('Operator_Id',$id)->get();
        foreach($gedung as $g)
        {
            $gid = $g->id;
        }
        $lantai = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Gedung_Id',$g->id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Gedung_Id',$g->id)->orderby('id','desc')->take(10)->get();
        return view('slot.opslot')->with('gedung',$gedung)->with('slot',$slot)->with('slot1',$slot1)->with('lantai',$lantai);
    }
    //Menambah Lantai Operator
    public function tambahlantai (Request $request)
    {
        $jumlahlantai= 0 ;
        $jumlahlantai = $request->jumlah + 1;
        DB::table('lantais')->insert([
            'Gedung_Id' => $request->gid,
            'Nama_Lantai'=> $request->namalantai,
            

        ]);
        DB::table('gedungs')->where('id',$request->gid)->update([
            'Jumlah_Lantai' =>$jumlahlantai,
        ]);
        return redirect('/opslotoperator/layout')->with('success','Berhasil Menambahkan Lantai');
    }
    //Menghapus Lantai Untuk Operator
    public function deletelantai(Request $request)
    {
        $jumlahlantai = 0 ;
        $jumlahlantai = $request->jumlah - 1;
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$request->lid)->get();
        if(count($slot) == 0){
            DB::table('gedungs')->where('id',$request->gid)->update([
                'Jumlah_Lantai' =>$jumlahlantai,
            ]);
            //$slot = DB::table('slot_parkirs')->where('id',$request->)
            DB::table('lantais')->where('id',$request->lid)->delete();
            return redirect('/opslotoperator/layout')->with('success','Berhasil Menghapus Lantai');
        }
        else
            return redirect('/opslotoperator/layout')->with('error','Tidak Bisa Menghapus Lantai');


        
    }
    //Menampilkan Halaman Lantai Untuk Operator
    public function indexlantaioperator($id)
    {
        $userid = auth()->user()->id;
        $lantai = DB::table('lantais')->where('id',$id)->get();
        if(count($lantai) == 0)
        {
            return redirect('/opslotoperator/layout')->with('error','Page Tidak Bisa Ditemukan');
        }
        
        foreach($lantai as $l)
        {
            $gid = $l->Gedung_Id;
        }
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        foreach($gedung as $g)
        {
            $opid = $g->Operator_Id;
        }
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        if ($opid == $userid)
            return view('lantai.lantaiop')->with('gedung',$gedung)->with('slot',$slot)->with('slot1',$slot1)->with('lantai',$lantai)->with('lantai1',$lantai1);
        else
            return redirect('/opslotoperator/layout')->with('error','Anda Tidak Punya Hak Untuk Mengakses Page Ini');
    }
    public function edit ($id)
    {
        $infoslot = DB::table('slot_parkirs')->where('id',$id)->get();
        foreach ($infoslot as $s){
            $lid = $s->Lantai_Id;
        }
        $slot1= DB::table('slot_parkirs')->where('Lantai_Id',$lid)->get();
        $lantai = DB::table('lantais')->where('id',$lid)->get();
        return view('lantai.slotlantaiop')->with('infoslot',$infoslot)->with('slot1',$slot1)->with('lantai',$lantai);
    
        
        //$op_id = auth()->user()->id;
        //$gedung = DB::table('gedungs')->where('Operator_Id',$op_id)->get();
       // foreach($gedung as $g)
         //   $gedung_id = $g->id;
        //$slotparkir = DB::table('slot_parkirs')->get();
        //$infoslot = DB::table('slot_parkirs')->where('id',$id)->get();
        //foreach($infoslot as $info)
         //   $gedungslot_id = $info->Gedung_Id;
        //if(count($infoslot) == 0){
         //   return redirect('/opslotoperator/layout')->with('error','Halaman Tidak Ditemui');
        //}
        //if($gedung_id == $gedungslot_id){
          //  return view('slot.opslot1')->with('gedung',$gedung)->with('slotparkir',$slotparkir)->with('infoslot',$infoslot);     
        //}
        //else{
          //  return redirect('/opslotoperator/layout')->with('error','Tidak Memiliki Hak Untuk Mengakses');
        //}
        
    }
    //Tambah Layout Untuk Operator
    public function tambah (Request $request)
    {
        $total = $request->in;
        for($i=0;$i<$total;$i++){
            DB::table('slot_parkirs')->insert([
                'Lantai_Id' => $request->lid,
                'Gedung_Id' => $request->gid,
            ]);
        }
        DB::table('lantais')->where('id',$request->lid)->update([
            'Jumlah_Slot' => 0,
        ]);
        return redirect()->action(
            'OperatorSlotController@indexlantaioperator',['id' => $request->lid]
        )->with('success','Berhasil Menambahkan Layout');
    }
    //Tambah 10 Slot Untuk Operator

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
            'OperatorSlotController@indexlantaioperator',['id' => $id]
        )->with('success','Berhasil Menambahkan Slot');
        //return redirect('opslotoperator/layout')->with('success','Berhasil Menambahkan Slot');

    }
    //Delete 10 Slot Parkir Untuk Operator
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
    
                
            DB::table('slot_parkirs')->where('Lantai_Id',$request->lid)->orderBY('id','desc')->take(10)->delete();
                
            return redirect()->action(
                'OperatorSlotController@indexlantaioperator',['id' => $request->lid]
            )->with('success','Berhasil Menghapus Slot');
            //return redirect('opslotoperator/layout')->with('success','Berhasil Menghapus Slot');

        }
        else
            return redirect()->action(
            'OperatorSlotController@indexlantaioperator',['id' => $request->lid]
            )->with('success','Tidak Bisa Menghapus Layout');
       // return redirect()->action(
           // 'SlotParkirController@index',['id' => $request->gid]
       // )->with('error','Tidak Bisa Menghapus Layout');

    }
    public function store(Request $request)
    {
        if(strlen($request->nama) == 0)
        {    
            return redirect('opslotoperator/layout')->with('error','Nama Slot Tidak Boleh Kosong');

        }
        else if(strlen($request->nama) < 5)
        {
            DB::table('slot_parkirs')->where('id',$request->id)->update([
                'Nama_Slot' => $request->nama,
                'Status_Slot' => $request->status,
            ]);	
            $jumlah = 0;
            $jumlahslot = $request->jslot;      
            $jumlah = $jumlahslot + 1;
            if($request->status != 0){
                DB::table('gedungs')->where('id',$request->gedungid)->update([
                    'Jumlah_Slot' => $jumlah,
                    ]);
            }           
            return redirect('opslotoperator/layout')->with('success','Berhasil Menambah Slot');

        }
        else{
            return redirect('opslotoperator/layout')->with('error','Untuk Nama Slot Max 4');
        }
        
    }
    public function store1(Request $request)
    {
        DB::table('slot_parkirs')->where('id',$request->id)->update([
            'Nama_Slot' => $request->nama,
            'Status_Slot' => $request->status,
        ]);	
        $jumlah = 0;
        $jumlahslot = $request->jslot;      
        $jumlah = $jumlahslot - 1;
        DB::table('gedungs')->where('id',$request->gedungid)->update([
            'Jumlah_Slot' => $jumlah,
        ]);
        return redirect('/opslotoperator/layout')->with('success','Data SlotParkir Berhasil Dihapus');
    }
    public function fulldelete(Request $request)
    {
        
        if($request->b1 == 0){
            DB::table('slot_parkirs')->where('Gedung_Id',$request->gid)->delete();
        
            DB::table('gedungs')->where('id',$request->gid)->update([
                'Jumlah_Slot' => -1,
            ]);
            return redirect('opslotoperator/layout')->with('success','Berhasil Menghapus Layout');
        }
        else
            return redirect('opslotoperator/layout')->with('success','Berhasil Menghapus Layout');
    }
    

}
