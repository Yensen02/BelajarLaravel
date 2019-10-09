
@extends('layouts.appa')

@section('content')

<link href="{{asset('css/slotadmintest.css')}}" rel="stylesheet">

<div class="container">
<?php $a=0; $b=0; 

$a1=0; $b1=0;
?>
<script language="JavaScript">
    function toggle(source) {
    checkboxes = document.getElementsByName('knk[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
    }
  }
</script>   
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
@foreach($lantai as $l)    
            <a href="/lantaitest/{{$l->id}}"><div class="btn btn-primary">Add</div></a>
            <a href="/lantaitestdelete/{{$l->id}}"><div class="btn btn-danger">Delete</div></a>
@endforeach
@endforeach
</br></br></br>
<form action="/lantaitest/tambah" method="post">
    {{ csrf_field() }}
<div class="badan"> 
        <input type="checkbox" onClick="toggle(this)" /> Toggle All<br/>        
<div class="isi">       
    <!--Cetak Slot Lantai -->
   
          
        @foreach($slot as $sub)
            
                    @if($sub->Status_Slot == 0)
                    <div class="kotak"><input type="checkbox" name="knk[]" value="{{$sub->id}}" ></div>
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
<div class="zer">
        
        @foreach ($lantai as $l)
        Nama Slot</br>
        <input type="text" name="namaslot" required>
        <input type="hidden" name="lid" value="{{$l->id}}">
        <input type="hidden" name="jl" value="{{$l->Jumlah_Slot}}">
        </br>
        Range</br>
        <input type="number" name="range" required>
        <input type="submit" value="Send">
                
              
        
@endforeach
           
    
</div>
</div>
</form>
</form>
      

@endsection