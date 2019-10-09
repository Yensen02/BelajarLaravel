@extends('layouts.appa')

@section('content')
<div class="container">

<form action ="/slot/show" method="post"> 
            {{ csrf_field() }} 
<h4>Nama Gedung      
<select name="gid" class="ko"> 
@foreach($gedung as $g)                                               
    <option value="{{$g->id}}" name="gid" class="">{{$g->Nama_Gedung}}</option>
 @endforeach
</select>
<input type="submit" value="Go">
</form>      
</div>
@endsection