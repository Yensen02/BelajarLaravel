<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gedung;
use DB;

class OperatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    public function index()
    {
        return view ('operator');
    }
    public function lantaiindex()
    {
        $id = auth()->user()->id;
        $gedung = DB::table('gedungs')->where('Operator_Id',$id)->get();    
        foreach($gedung as $g)
        {
            $gid = $g->id;
        }
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        return view('lantai.lantai')->with('gedung',$gedung)->with('slot',$slot)->with('slot1',$slot1)->with('lantai',$lantai)->with('lantai1',$lantai1);

    }
    public function slotindex($id)
    {
        $gedung = DB::table('gedungs')->where('id',$id)->get();
        $slotparkir = DB::table('slot_parkirs')->where('Gedung_Id',$id)->get();
        return view('slot.layout')->with('gedung',$gedung)->with('slotparkir',$slotparkir);       
    }
    public function profile()
    {
        $op_id = auth()->user()->id;
        $gedung = DB::table('gedungs')->where('Operator_Id',$op_id)->get();
        return view ('opprofile')->with('gedung',$gedung);
  
    }
}
