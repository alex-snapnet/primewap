

<div class="modal" id="addUserModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                      <form class="forms-sample" id="addUserForm">
                             <div class="form-group">
                          <label for="">Name</label>
                          <textarea rows="5" name="name" id="name" class="form-control"></textarea>
                        </div>
                        <input type="hidden" id="userID" name="id">
                         <div class="form-group">
                          <label for="">Email</label>
                          <textarea name="email" id="email" rows="5" class="form-control"></textarea>
                        </div>  
                         <div class="form-group">
                          <label for="">Password</label>
                          <input type="password" name="password" id="password"  class="form-control">
                        </div> 
                         <div class="form-group">
                          <label for="">Password Confirmation</label>
                          <input type="password" name="password_confirm" id="password_confirm"  class="form-control">
                        </div> 
                         <div class="form-group">
                          <label for="">Role</label>
                          <select name="type2" id="type" class="form-control">
                           <option value="prime_super">Prime Super Admin</option>
                           <option value="prime_admin">Prime Admin</option>
                           <option value="prime_osp">Prime Operation Rep</option> 
                          </select>
                        </div>
                           <div class="form-group">
                          <span class="addedBy"></span>
                          
                        </div> 
                        <input type="hidden" value="addUser" name="type">
                        </form>
                     
                   
      </div>
      <div class="modal-footer">
      <button id="submitUserForm" class="btn btn-success mr-2">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         
      </div>
    </div>
  </div>
</div>


 
