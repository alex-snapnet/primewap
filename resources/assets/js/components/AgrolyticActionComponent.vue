<template>
  
  <span>


<!-- comment thread section start -->

<div  class="modal fade" :id="id" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Menu Options</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

     <div>
       <!-- content start -->

  <div class="dropdown-menu show" style=";display: block;position: relative;width: 100%;border: 0;">

    <!-- edit button -->
    <a id="a-edit"  href=""  class="dropdown-item" data-toggle="modal" data-target="#agrolyticModal">Edit</a>


    <!-- preview button -->
    <a id="a-preview"  href=""  class="dropdown-item" data-toggle="modal" data-target="#agrolyticModal">Preview</a>

    <!-- assign to op-rep -->
    <a id="a-assign"  href=""  class="dropdown-item"  data-toggle="modal" data-target="#assignOpRepModal">Assign To Operation Rep.</a>

    <!-- assign to third party -->
    <a id="a-third-party" v-show="isPrimeOsp()" title="This is a temporal priviledge , should be used when on leave or not in access" href=""  class="dropdown-item" >Assign To Third Party.</a>

    <!-- remove -->
    <a id="a-remove"  href=""  class="dropdown-item">Remove</a>
    
    <!-- add report -->
    <a id="a-add-report"   href="#" data-target="#reportModal" data-toggle="modal" class="dropdown-item">Add Report</a>

    <!-- add comment -->
    <a id="a-add-comment"   href="" data-target="#commentModal" data-toggle="modal" class="dropdown-item">Add Comment</a>

    <!-- view report -->
    <a id="a-view-report" target="_blank" :href="getReportLink()"  class="dropdown-item">View Reports</a>

    <!-- view comments -->
    <a id="a-view-comment" href="#"  data-target="#commentThreadModal" data-toggle="modal" class="dropdown-item">View Comments</a>


<!-- /manage-agrolytic -->
  </div>


       <!-- content stop -->
     </div>


    </div>
  </div>
</div>

<!-- comment thread section stop -->

  <!-- <button class="btn btn-sm btn-info" :data-target="getDataTarget()" data-toggle="modal">Action</button> -->

<!-- <nav role="navigation"> -->
  <!-- <ul>
    <li><a href="#">One</a></li>
    <li><a href="#">Two</a>
      <ul class="dropdown">
        <li><a href="#">Sub-1</a></li>
        <li><a href="#">Sub-2</a></li>
        <li><a href="#">Sub-3</a></li>
      </ul>
    </li>
    <li><a href="#">Three</a></li>
  </ul> -->
<!-- </nav> -->

 <select  style=";text-align: center;font-size: 11px;text-transform: uppercase;" v-model="actions">

     <option value="none">-- Actions --</option>

 <optgroup label="Task">
     <option v-show="isPrimeAdmin()" value="edit">Edit</option>
     <option value="preview">Preview</option>
     <option v-show="isPrimeAdmin()" value="assign">Assign To Operation-Rep</option>
     <option v-show="isPrimeOsp()" value="third-party">Assign To Third-Party</option>
     <option v-show="isPrimeAdmin()" value="remove">Remove</option>
 </optgroup>

 <optgroup label="Milestones">
     <option value="add-report">Add Milestone</option>
     <option value="view-report">View Milestone</option>
 </optgroup>


 <optgroup label="Comment">
     <option value="add-comment">Add Comment</option>
     <option value="view-comment">View Comment</option>
 </optgroup>

 <optgroup label="Sort">
     <option value="agro-cat">Agrolytics In This Category</option>
     <option value="agro-sec">Agrolytics In This Sector</option>
 </optgroup>


 </select>


  </span>



</template>

<script>
// import SectorMixin from './mixins';


export default {
    
    props:[
        'id',
        'data',
        'role',
        'user_id'
    ],
    data(){
       return {
           jQ:$,
           actions:'none'
       }
    },
    watch:{
        
        actions(n,o){
            
            if (n == 'edit'){
               this.$emit('linktoForm',this.data);
               $('#a-edit').trigger('click');
            }else if (n == 'preview'){
               this.$emit('doPreview',this.data);
               $('#a-preview').trigger('click');
            }else if (n == 'assign'){
               this.$emit('linktoForm',this.data);
               console.log(this.data);
               $('#a-assign').trigger('click');
            }else if (n == 'third-party'){
               $('#a-third-party').trigger('click');
            }else if (n == 'remove'){
               this.$emit('removeAgrolytic',this.data);
            }else if (n == 'add-report'){
               this.$emit('selectAgrolyticRow',this.data);
               $('#a-add-report').trigger('click');    
            }else if (n == 'add-comment'){
               this.$emit('selectAgrolyticRow',this.data);
               $('#a-add-comment').trigger('click');
            }else if (n == 'view-report'){
               location.href = this.getReportLink(); 
            }else if (n == 'view-comment'){
               this.$emit('linktoForm',this.data);
               this.$root.$emit('reloadComment',this.data.id);
               $('#a-view-comment').trigger('click');
            }else if (n == 'agro-cat'){
               this.$emit('setCategoryFilter',this.data);
            }else if (n == 'agro-sec'){
               this.$emit('setSectorFilter',this.data);
            }

            this.actions = 'none';

        }

    },
    methods:{
        
        autoDropDown($el){
            $($el).trigger('click');
            console.log($el);
        },

        getDataTarget(){
            return '#' + this.id;
        },
        // isPrimeAdminOnly(){
        //   return this.role == 'prime_admin';
        // },

        // isPrimeOspOnly(){
        //   return this.role == 'prime_osp';
        // },
        isPrimeAdmin(){
           return (this.role == 'prime_admin' && this.user_id == this.data.user_id);
        },

        isPrimeOsp(){
          return (this.role == 'prime_osp' && this.data.op_rep == this.user_id); 
        },

        getReportLink(){
          return '/manage-report/' + this.data.id;
        },

        hideModal(){
          $('.modal').trigger('click');
        },

        toggleModal(id){
            $('#' + this.id).on('hidden.bs.modal', function() {
                // $('#' + id).modal("toggle");
                $('#' + id).modal('focus')
                alert('ok');
            });    
            alert(0);        
            $('#' + this.id).modal("dispose");

// $('#' + this.id).modal("hide");
        }

    }    
}
</script>


<style scoped>


li {
 display: block;
 transition-duration: 0.5s;
}

li:hover {
  cursor: pointer;
}

ul li ul {
  visibility: hidden;
  opacity: 0;
  position: absolute;
  transition: all 0.5s ease;
  margin-top: 1rem;
  left: 0;
  display: none;
}

ul li:hover > ul,
ul li:focus-within > ul,
ul li ul:hover {
  visibility: visible;
  opacity: 1;
  display: block;
}


ul li ul li {
  clear: both;
  width: 100%;
}


</style>
