
@extends('layouts.appa')

@section('content')

<link href="{{asset('css/slotadmin.css')}}" rel="stylesheet">
<div class="container">
<?php $a=0; $b=0; 

$a1=0; $b1=0;
?>

<form action ="/slot/tambahlayout" method="post"> 
            {{ csrf_field() }} 
<h4>Nama Gedung

@foreach($gedung as $g)                                               
       <input type="text" value="{{$g->Nama_Gedung}}" readonly class="">
       <a href="#tambah1" data-toggle="modal" class="btn btn-primary">Tambah Lantai</a>
       <a href="#delete1" data-toggle="modal" class="btn btn-danger">Delete Lantai</a>
       @include('inc.modal1')
</form>  
</br></br>
@foreach($lantai as $l)
<a href="/lantai/{{$l->id}}"><div class="btn btn-primary">{{$l->Nama_Lantai}}</div></a>
@endforeach

</br></br>

      
      
@endforeach

@endsection