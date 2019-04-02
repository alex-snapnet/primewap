

<div class="modal" id="addCustomerInformationModal"  role="dialog">
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
              <label for="">Customer Information</label>
              <textarea name="information" id="information" rows="20" class="form-control fancytextbox"></textarea>
           </div>   
      		<input type="hidden" name="type" value="addCustomerInformation">
          <input type="hidden"  name="id" class="cust_id">
      		<input type="hidden"  name="user_id" value="{{Auth::user()->id}}">
      	</form>
      </div>
      <div class="modal-footer">
      <button id="submitCustomerInformation" class="btn btn-success mr-2">Save Information</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         
      </div>
    </div>
  </div>
</div>

<!--  -->