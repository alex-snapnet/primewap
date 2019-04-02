
<div class="modal" id="assignAgrolytic"  role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Assign to Operation Rep</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      	<form id="assignTo" >
      		<select id="osp" name="op_rep" style="width: 100%">
      			<option value=""> -Select Operation Rep- </option>
      		</select>
      		<input type="hidden" name="type" value="assignToOsp">
      		<input type="hidden"  name="id" class="agro_id" >
      	</form>
      </div>
      <div class="modal-footer">
      <button id="submitFormAssign" class="btn btn-success mr-2">Assign</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         
      </div>
    </div>
  </div>
</div>

<!--  -->