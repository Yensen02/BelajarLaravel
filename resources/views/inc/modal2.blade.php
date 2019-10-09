<?php // Delete Modal Untuk Admin?>
<div class="modal modal-danger fade" id="deletefull" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
    
              <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <form action="/slot/deletefull" method="post">
                {{ csrf_field() }}
                @foreach($slot as $sub)
                    
                @if($sub->Status_Slot == 2)
                    <?php $b=$b+1;?>
                @elseif($sub->Status_Slot == 3 || $sub->Status_Slot == 4)
                    <?php $b1=$b1+1;?>
                @endif
                @endforeach
                
                @foreach($lantai as $l)
                  <input type="hidden" name="b" value="{{$b}}">   
                  
                  <input type="hidden" name="gid" value="{{$g->id}}">
                  <input type="hidden" name="b1" value="{{$b1}}">
                  <input type="hidden" name="lid" value="{{$l->id}}">
                  @endforeach
              
        
            <div class="modal-body">
                      <p class="text-center">
                          Apakah Anda Ingin Menghapus Layout?
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
    
  <?php // Delete Modal Untuk Operator ?>
      
      <div class="modal modal-danger fade" id="deleteopfull" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
      
                <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
              </div>
              <form action="/opslotoperator/deletefull" method="post">
                  {{ csrf_field() }}
                  @foreach($slot as $sub)
                      
                  @if($sub->Status_Slot == 2)
                      <?php $b=$b+1;?>
                  @elseif($sub->Status_Slot == 3 || $sub->Status_Slot == 4)
                      <?php $b1=$b1+1;?>
                  @endif
                  @endforeach
                  @foreach($lantai as $l)
                  <input type="hidden" name="b" value="{{$b}}">   
                  
                  <input type="hidden" name="gid" value="{{$g->id}}">
                  <input type="hidden" name="b1" value="{{$b1}}">
                  <input type="hidden" name="lid" value="{{$l->id}}">
                  @endforeach
              <div class="modal-body">
                        <p class="text-center">
                            Apakah Anda Ingin Menghapus Layout?
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
        
              