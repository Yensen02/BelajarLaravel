<?php //Modal Untuk Delete 10 Slot Terakhir Untuk Admin?>
<div class="modal modal-danger fade" id="delete10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
        </div><form action="/slot/delete/" method="post">
          {{ csrf_field() }} 

          @foreach($slot1 as $sub1)
    
              @if($sub1->Status_Slot == 2)
                  <?php $a=$a+1;?>
              @elseif($sub1->Status_Slot == 3)
                  <?php $a1=$a1+1;?>
              @elseif($sub1->Status_Slot == 4)
                  <?php $a1=$a1+1;?>
              @endif
              
                      
          @endforeach
          @foreach($lantai as $l)
          <input type="hidden" name="a" value="{{$a}}">
          <input type="hidden" name="a1" value="{{$a1}}">
          <input type="hidden" name="jumlah" value="{{$l->Jumlah_Slot}}">

          <input type="hidden" name="gid" value="{{$g->id}}">
          <input type="hidden" name="lid" value="{{$l->id}}">
          @endforeach
            <div class="modal-body">
                  <p class="text-center">
                      Apakah Anda Ingin Menghapus 10 Slot Parkir Paling Terakhir?
                  </p>
                
  
            </div>
            <div class="modal-footer">
              
              <button type="submit" class="btn btn-primary">Yes</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </form>
              
            </div>
        </form>
      </div>
    </div>
  </div>
  <?php //Modal Untuk Tambah Lantai Untuk Admin ?>
  <div class="modal modal-danger fade" id="tambah1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
  
            <h4 class="modal-title text-center" id="myModalLabel">Tambah Lantai</h4>
          </div><form action="/slot/tambahlantai" method="post">
            {{ csrf_field() }} 
              <div class="modal-body">
                    <p class="text-center">
                        Nama Lantai <input type="text" name="namalantai">
                        <input type="hidden" name="gid" value="{{$g->id}}">
                        
                    <input type="hidden" name="jumlah" value="{{$g->Jumlah_Lantai}}">
                    </p>
                  
    
              </div>
              <div class="modal-footer">
                
                <button type="submit" class="btn btn-primary">Tambah</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
              </form>
                
              </div>
          </form>
        </div>
      </div>
    </div>
    <?php //Modal Delete 10 Slot Terakhir Untuk Operator?>
    <div class="modal modal-danger fade" id="deleteop10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
  
            <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
          </div><form action="/opslotoperator/delete10" method="post">
            {{ csrf_field() }} 
            @foreach($slot1 as $sub1)
      
                @if($sub1->Status_Slot == 2)
                    <?php $a=$a+1;?>
                @elseif($sub1->Status_Slot == 3)
                    <?php $a1=$a1+1;?>
                @elseif($sub1->Status_Slot == 4)
                    <?php $a1=$a1+1;?>
                @endif
                
                        
            @endforeach
            <input type="hidden" name="a" value="{{$a}}">
            <input type="hidden" name="a1" value="{{$a1}}">
            <input type="hidden" name="jumlah" value="{{$g->Jumlah_Slot}}">
  
            <input type="hidden" name="gid" value="{{$g->id}}">
            @foreach($lantai as $l)
              <input type="hidden" name="lid" value="{{$l->id}}">
            @endforeach
  
              <div class="modal-body">
                    <p class="text-center">
                        Apakah Anda Ingin Menghapus 10 Slot Parkir Paling Terakhir?
                    </p>
                  
    
              </div>
              <div class="modal-footer">
                
                <button type="submit" class="btn btn-primary">Yes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
              </form>
                
              </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal modal-danger fade" id="delete1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
  
            <h4 class="modal-title text-center" id="myModalLabel">Delete Lantai</h4>
          </div><form action="/slot/deletelantai" method="post">

            {{ csrf_field() }} 
              <div class="modal-body">
                  @if(count($lantai) > 0)
                    <p class="text-center">
                        Nama Lantai 
                        
                        <select name="lid">
                        
                        @foreach($lantai as $l)
                        <option value="{{$l->id}}">{{$l->Nama_Lantai}}</option>
                        @endforeach
                  </select>
                        <input type="hidden" name="gid" value="{{$g->id}}">
                        <input type="hidden" name="jumlah" value="{{$g->Jumlah_Lantai}}">
                    </p>
                 @else
                    <p class="text-center">Tidak Ada Daftar Lantai</p>
                    @endif    
              </div>
             
            
              <div class="modal-footer">
                  @if(count($lantai) > 0)
                <button type="submit" class="btn btn-primary">Delete</button>
                  @endif
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
              </form>
                
              </div>
          </form>
        </div>
      </div>
    </div>
<?php //Modal Untuk Tambah Lantai Untuk Operator?>
    <div class="modal modal-danger fade" id="tambahop1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
  
            <h4 class="modal-title text-center" id="myModalLabel">Tambah Lantai</h4>
          </div><form action="/opslotoperator/tambahlantai" method="post">
            {{ csrf_field() }} 
              <div class="modal-body">
                    <p class="text-center">
                        Nama Lantai <input type="text" name="namalantai">
                        <input type="hidden" name="gid" value="{{$g->id}}">
                        
                        <input type="hidden" name="jumlah" value="{{$g->Jumlah_Lantai}}">
                    </p>
                  
    
              </div>
              <div class="modal-footer">
                
                <button type="submit" class="btn btn-primary">Tambah</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
              </form>
                
              </div>
          </form>
        </div>
      </div>
    </div>

    
    <div class="modal modal-danger fade" id="deleteop1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
  
            <h4 class="modal-title text-center" id="myModalLabel">Delete Lantai</h4>
          </div><form action="/opslotoperator/deletelantai" method="post">

            {{ csrf_field() }} 
              <div class="modal-body">
                  @if(count($lantai) > 0)
                    <p class="text-center">
                        Nama Lantai 
                        
                        <select name="lid">
                        
                        @foreach($lantai as $l)
                        <option value="{{$l->id}}">{{$l->Nama_Lantai}}</option>
                        @endforeach
                  </select>
                        <input type="hidden" name="gid" value="{{$g->id}}">
                        <input type="hidden" name="jumlah" value="{{$g->Jumlah_Lantai}}">
                
                    </p>
                 @else
                    <p class="text-center">Tidak Ada Daftar Lantai</p>
                    @endif    
              </div>
             
            
              <div class="modal-footer">
                  @if(count($lantai) > 0)
                <button type="submit" class="btn btn-primary">Delete</button>
                  @endif
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
              </form>
                
              </div>
          </form>
        </div>
      </div>
    </div>
     