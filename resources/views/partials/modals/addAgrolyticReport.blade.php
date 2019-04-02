

<div class="modal" id="addAgrolyticReportModal"  role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      	<form id="addAgrolyticReportForm" >
      		 <div class="form-group">
              <label for="">Report</label>
              <textarea name="report" id="report" rows="10" class="form-control"></textarea>
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
                          <label for="">Status</label>
                          <select name="prog_status" id="prog_status" class="form-control">
                            @for($i=0; $i<=100; $i+=10)
                           <option value="{{$i}}%">{{$i}}%</option> 
                           @endfor
                          </select>
                        </div> 
           <div class="form-group">
              <label for="">Date</label>
              <input type="date" name="day_week" id="day_week" class="form-control">
           </div> 
               <div class="form-group">
                          <span class="addedBy"></span>
                          
                </div> 
      		<input type="hidden" name="type" value="addAgrolyticReport">
          <input type="hidden"  name="agro_id" class="agro_id" >
      		<input type="hidden"  name="user_id" value="{{Auth::user()->id}}">
      	</form>
      </div>
      <div class="modal-footer">
      <button id="submitAgrolyticReport" class="btn btn-success mr-2">Submit Report</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         
      </div>
    </div>
  </div>
</div>

<!--  -->