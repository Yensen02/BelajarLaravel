@extends('layouts.appc')
    
@section('content')
<link href="{{asset('css/slotadmin1.css')}}" rel="stylesheet">
    <div class="container"> 
        @foreach($gedung as $g)
        <h2>{{$g->Nama_Gedung}}</h2>
    
    </br></br>
        <div class="isi">       
            @foreach($slotparkir as $sub)
                @if ($g->id == $sub->Gedung_Id)
                        @if($sub->Status_Slot == 0)
                            <a href="/opslotoperator/layout/{{$sub->id}}"><div class="kotak">{{$sub->Nama_Slot}}</div></a>
                        @elseif($sub->Status_Slot == 2)
                            <a href="/opslotoperator/layout/{{$sub->id}}"><div class="kotak1">{{$sub->Nama_Slot}}</div></a>
                        @elseif($sub->Status_Slot == 3)
                            <a href="/opslotoperator/layout/{{$sub->id}}"><div class="kotak2">{{$sub->Nama_Slot}}</div></a>
                        @elseif($sub->Status_Slot == 4)
                            <a href="/opslotoperator/layout/{{$sub->id}}"><div class="kotak3">{{$sub->Nama_Slot}}<div></a>
                    @endif
                @endif
            @endforeach       
        </div>
        
        
        
    </br>
    </div>
    <div class="zer">
    
        
           
            @foreach($infoslot as $Info)
            <form action ="/opslotoperator/editinfo" method="post">
                {{ csrf_field() }}
            <h3>Nama Slot</h2> 
            <input type="text" value="{{$Info->Nama_Slot}}" class="input1" placeholder="Nama Slot" name="nama"></input>
            <input type="hidden" value="{{$Info->id}}" name="id"></input>
            <input type="hidden" value="2" name="status"></input>
            <input type="hidden" value="{{$g->Jumlah_Slot}}" name="jslot">
            <INPUT TYPE="hidden" value="{{$g->id}}" name="gedungid">
            </br></br>
            <input type="submit" class="btn btn-primary" value="Edit"></input>
        
            </form>
             @if($Info->Status_Slot == 0)
             
             @else
        </br>
            <form action="/opslotoperator/deleteinfo" method="post">
                {{ csrf_field() }}
                <input type="hidden" value="" name="nama"></input>
                <input type="hidden" value="{{$Info->id}}" name="id"></input>
                <input type="hidden" value="0" name="status"></input>
                <input type="hidden" value="{{$g->Jumlah_Slot}}" name="jslot">
                <INPUT TYPE="hidden" value="{{$g->id}}" name="gedungid">
                <input type="submit" class="btn btn-primary" value="Delete"></input>  
            </form>         
             @endif
             
            @endforeach
    </div>
    
    @endforeach    
    @endsection