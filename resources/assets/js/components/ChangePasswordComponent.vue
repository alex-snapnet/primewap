<template>
  
  <span>

<!-- comment modal start -->
<div class="modal fade" id="changePasswordModal11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="color: #000;">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Change Password </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      
      <div class="modal-body">

          <div class="container">
              <div class="row">

        <div class="col-md-12">

<form @submit.prevent="changePassword">
           <div class="form-group col-md-12">
               <label for="">
                   Password
               </label>
               <input placeholder="Password" class="form-control" v-model="data.password" type="password" />
           </div>  

           <div class="form-group col-md-12">
               <label for="">
                  Confirm Password
               </label>
               <input placeholder="Confirm Password" class="form-control" v-model="data.password_confirm" type="password" />
           </div>  


           <div class="form-group col-md-12">
               <button class="btn btn-primary"> {{ buttonText }} </button>

           </div>
</form>
           <div style="clear: both;"></div> 

<!-- content start -->

<!-- content stop -->

        </div>

              </div>
          </div>
        

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>

      


    </div>
  </div>
</div>

<!-- comment modal stop -->


     
<!-- stop -->


<!-- excel-to-json -->

<!-- sub here -->

  </span>



</template>

<script>
export default {
// user-change-password/{user}
    data(){
         
         return {
            buttonText:'Change Password', 
            data:{
                password:'',
                password_confirm:''
            },
            apiChangePassword:baseURL + 'user-change-password/' + authUser
         }

    },

    mounted(){
      
    },

    methods: {
        
        changePassword(){
           this.buttonText = 'Changing Password'; 
           fetch(this.apiChangePassword,{
               method:'POST',
               body:JSON.stringify(this.data),
               headers:{
                   'content-Type':'application/json'
               }
           })
           .then(res=>res.json())
           .then(res=>{
               this.buttonText = 'Change Password'; 
               this.scanResponse(res);
           });
        },

        scanResponse(res){
          if (res.message){
             if (res.error){
                toastr.error(res.message);
             }else{
                 toastr.success(res.message);
             }
          }else{
              toastr.success('Done');
          }  
        }



        
    }
    
}
</script>


<style scoped>
 .page-link{
   color: #000 !important;
 }
</style>