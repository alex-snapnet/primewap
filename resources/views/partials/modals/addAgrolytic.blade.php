<div class="modal" id="addAgrolytic"   role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agrolytic</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                      <form class="forms-sample" id="addAgrolyticForm">
                             <div class="form-group">
                          <label for="">PAGroup Objectives</label>
                          <textarea rows="5" name="pag_objective" id="pag_objective" class="form-control"></textarea>
                        </div>
                        <input type="hidden" id="id" name="id">
                         <div class="form-group">
                          <label for="">Company Objectives</label>
                          <textarea name="comp_objective" id="comp_objective" rows="5" class="form-control"></textarea>
                        </div>  
                         <div class="form-group">
                          <label for="">Prospect/Client</label>
                            <select name="prospect" id="prospect" class="form-control">
                            <option value="">-Select Customer-</option>

                            @if(count(Auth::user()->customers())>0)
                              @foreach(Auth::user()->customers() as $customer)
                                <option value="{{$customer->name}}">{{$customer->name}}</option>
                              @endforeach
                            @endif
                          </select>


                        </div> 
                        <div class="form-group">
                          <label for="">Category</label>
                          <select name="cat_id" id="cat_id" class="form-control">
                            <option value="">-Select Category-</option>

                            @if(count($categories)>0)
                              @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                            @endif
                          </select>
                        </div>
                         <div class="form-group">
                          <label for="">Lifecycle</label>
                          <select name="status" id="status" class="form-control">
                           <option value="Perpetual">Perpetual</option>
                           <option value="Purchase">Purchase</option>
                           <option value="Pipeline">Pipeline</option>
                           <option value="Prospect">Prospect</option>
                           <option value="Present">Present</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="">Assign to Operation Rep</label>

                          <select id="ospA" name="op_rep" style="width: 100%">
                            <option value=""> -Select Operation Rep- </option>
                          </select>
                        </div>
                        <input type="hidden" value="addAgrolytic" name="type">
                        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                        <input type="hidden" value="{{Auth::user()->id}}" name="lmodified_id">
                         <div class="form-group">
                          <label for="">Initiative</label>
                          <textarea name="initiative" id="initiative" rows="5" class="form-control"></textarea>
                        </div> 
                           <div class="form-group">
                          <span class="addedBy"></span>
                          
                          </div> 
                        </form>
                     
                   
      </div>
      <div class="modal-footer">
      <button id="submitForm" class="btn btn-success mr-2">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         
      </div>
    </div>
  </div>
</div>


 
