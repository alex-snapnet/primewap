<div class="modal" id="addComment"  role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Manager's Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      	<form id="addManagerComment" >
      		 <div class="form-group">
              <label for="">Comment</label>
              <textarea name="comment" id="comment" rows="10" class="form-control"></textarea>
           </div>   
          <input type="hidden" name="type" value="addComment">
      		<input type="hidden" name="type2" id="type2" >
          <input type="hidden"  name="agro_id" class="agro_id">
          <input type="hidden"  name="id" class="id">
          <input type="hidden"  name="user_id" value="{{Auth::user()->id}}">
      		<input type="hidden"  name="lmodified_id" value="{{Auth::user()->id}}">
          

      	</form>
      </div>
      <div class="modal-footer">
      <button id="submitManagerComment" class="btn btn-success mr-2">Add Comment</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         
      </div>
    </div>
  </div>
</div>

<!--  --> 

