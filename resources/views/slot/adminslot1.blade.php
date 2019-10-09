
@extends('layouts.appa')

@section('content')
<link href="{{asset('css/slotadmin1.css')}}" rel="stylesheet">
<div class="container">
<?php $a=0; $b=0; 

$a1=0; $b1=0;
?>


<h4>Nama Gedung      

@foreach($gedung as $g)                                               
       <input type="text" value="{{$g->Nama_Gedung}}" readonly class="">
 
</br></br>
<div class="isi">       
        @foreach($slot1 as $sub)
                @if($g->id == $sub->Gedung_Id)
                
                    @if($sub->Status_Slot == 0)
                    <a href="/slotparkir/{{$sub->id}}"><div class="kotak"></div></a>
                    @elseif($sub->Status_Slot == 2)
                    <a href="/slotparkir/{{$sub->id}}"><div class="kotak1">{{$sub->Nama_Slot}}</div></a>
                    @elseif($sub->Status_Slot == 3)
                    <a href="/slotparkir/{{$sub->id}}"><div class="kotak2">{{$sub->Nama_Slot}}</div></a>
                    @elseif($sub->Status_Slot == 4)
                    <a href="/slotparkir/{{$sub->id}}"><div class="kotak3">{{$sub->Nama_Slot}}</div></a>
                    @endif

                
                @endif
                   
            
        @endforeach  
            
      
        </div>
</div>
<div class="zer">
    
        
           
        @foreach($slot as $Info)
        <form action ="/slotparkir/editinfo" method="post">
            {{ csrf_field() }}
        <h3>Nama Slot</h2> 
        <input type="text" value="{{$Info->Nama_Slot}}" class="input1" placeholder="Nama Slot" name="nama"></input>
        <input type="hidden" value="{{$Info->id}}" name="id"></input>
        <input type="hidden" value="2" name="status"></input>
        <input type="hidden" value="{{$g->Jumlah_Slot}}" name="jslot">
        <INPUT TYPE="hidden" value="{{$g->id}}" name="gid">
        </br></br>
        <input type="submit" class="btn btn-primary" value="Edit"></input>
        </form>
         @if($Info->Status_Slot == 0)
         
         @else
    </br>
        <form action="/slotparkir/deleteinfo" method="post">
            {{ csrf_field() }}
            <input type="hidden" value="" name="nama"></input>
            <input type="hidden" value="{{$Info->id}}" name="id"></input>
            <input type="hidden" value="0" name="status"></input>
            <input type="hidden" value="{{$g->Jumlah_Slot}}" name="jslot">
            <INPUT TYPE="hidden" value="{{$g->id}}" name="gid">
            <input type="submit" class="btn btn-primary" value="Delete"></input>  
        </form>         
         @endif
         
        @endforeach
</div>

@endforeach

@endsection