
@extends('layouts.appa')

@section('content')

<link href="{{asset('css/slotadmin.css')}}" rel="stylesheet">
<div class="container">
<?php $a=0; $b=0; 

$a1=0; $b1=0;
?>
@foreach($lantai as $l)
<form action ="/lantai/tambahlayout" method="post"> 
            {{ csrf_field() }} 
<h4>Nama Gedung

@foreach($gedung as $g)                                               
       <input type="text" value="{{$g->Nama_Gedung}}" readonly class="">
       
       @if(count($slot) > 0)
       <a href="/slot/{{$l->id}}/add" class="btn btn-primary">Add</a>
</form>
<div class="d1">
        <a href="#delete10" data-toggle="modal" class="btn btn-danger">Delete Slot</a>
        @include('inc.modal1')
        
</div>
    <div class="d2">
     
    <a href="#deletefull" data-toggle="modal" class="btn btn-danger">Delete Layout</a>
     @include('inc.modal2')
</div>  
       @else
       <input type="hidden" value="{{$g->id}}" name="gid">
       <input type="hidden" value="{{$l->id}}" name="lid">
        <select name="in">
        <option value="30">30x30</option>
        <option value="50">50x50</option>
        <option value="70">70x70</option>
        <option value="90">90x90</option>
        </select>
        <input type="submit" class="btn btn-primary" value="Add Layout">
    </br>
       @endif
    </form>
       @include('inc.modal1')
  
@endforeach
</br>
<!--Cetak List Lantai -->
    @foreach($lantai1 as $l1)
        @if($l1->id == $l->id)          
            <a href="/lantai/{{$l1->id}}"><div class="btn btn-danger">{{$l1->Nama_Lantai}}</div></a>
        @else
            <a href="/lantai/{{$l1->id}}"><div class="btn btn-primary">{{$l1->Nama_Lantai}}</div></a>
        @endif
    @endforeach

@endforeach

</br></br></br>
<div class="isi">       
    <!--Cetak Slot Lantai -->
        @foreach($slot as $sub)
            
                    @if($sub->Status_Slot == 0)
                    <a href="/slotparkir/{{$sub->id}}"><div class="kotak"></div></a>
                    @elseif($sub->Status_Slot == 2)
                    <a href="/slotparkir/{{$sub->id}}"><div class="kotak1">{{$sub->Nama_Slot}}</div></a>
                    @elseif($sub->Status_Slot == 3)
                    <a href="/slotparkir/{{$sub->id}}"><div class="kotak2">{{$sub->Nama_Slot}}</div></a>
                    @elseif($sub->Status_Slot == 4)
                    <a href="/slotparkir/{{$sub->id}}"><div class="kotak3">{{$sub->Nama_Slot}}</div></a>
                @endif
            
        @endforeach  
            
      
        </div>
</div>
      
      

@endsection