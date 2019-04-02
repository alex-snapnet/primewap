

<div class="modal" id="addCustomerModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                      <form class="forms-sample" id="addCustomerForm">
                             <div class="form-group">
                          <label for="">Name</label>
                          <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <input type="hidden" id="custID" name="id">
                         <div class="form-group">
                          <label for="">Contact Email</label>
                          <textarea name="contact_email" id="contact_email" rows="3" class="form-control"></textarea>
                        </div>  
                         <div class="form-group">
                          <label for="">Address</label>
                          <input type="text" name="address" id="address"  class="form-control">
                        </div> 
                         <div class="form-group">
                          <label for="">Phone Number</label>
                          <input type="text" name="phone_num" id="phone_num"  class="form-control">
                        </div> 
                          
                        <input type="hidden" value="addCustomer" name="type">
                        <input type="hidden" value="{{Auth::user()->id}}" name="added_by">
                        <div class="form-group">
                          <span id="addedBy"></span>
                          
                        </div> 
                        
                        </form> 
                     
                   
      </div>
      <div class="modal-footer">
      <button id="submitCustomerForm" class="btn btn-success mr-2">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         
      </div>
    </div>
  </div>
</div>


 
