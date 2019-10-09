<style type="text/css">
.{
    width:900px;
    m
}
.th2{
    backrgound-color:red;
}
</style>
    @extends('layouts.appa')

    @section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                    <div class="card-header">Informasi Operator</div>
                        
                    <div class="card-body">
                        <p>Jumlah Operator : <?php echo count($operator) ?>
                
                            @if(count($operator) > 0) 
                            <table class="table table-striped">
                                    <tr>
                                        <th>Nama Operator</th>
                                        <th>Auth Gedung</th>
                                        <th></th>
                                        <th></th>   
                        
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Ganti Password</th>
                                        <th></th>
                                    </tr>
                                    @foreach($operator as $o)
                                        
                                        <tr>
                                            <th><a href="/slotoperator/{{$o->id}}">{{$o->Name_Operator}}</a></th>
                                        <th>    
                                            @foreach($gedung as $g)
                                              
                                                @if($o->id == $g->Operator_Id)
                                                    <a href="/gedung/{{$g->id}}">{{$g->Nama_Gedung}}</a>                       
                                                @endif                                        
                                            @endforeach
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        </th>   
                                            <th><a href="/slotoperator/{{$o->id}}/edit" class="btn btn-primary">Ganti Password</a></th>
                                            <th>
                                            <a href="/slotoperator/{{$o->id}}/deleteconfirm" class="btn btn-danger">Delete</a></th>
                                            @include('inc.modal')
                                            
  
                        
                                            
                                        </tr>  
                                        
                                
                            
                                    @endforeach
                    
                                @endif
                                       
                    </div>
                </div>
        
            </div>
        </div>
    </div>
    <!-- Modal -->


@endsection