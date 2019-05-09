<template>
  
  <span>

<!-- comment modal start -->
<div class="modal fade" id="themeSelectModal11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #000;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Choose Theme </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

          <div class="container">
              <div class="row">

        <div class="col-md-12">
          
         <span v-for="thm in themes" :key="thm.value">


         <form @submit.prevent="saveTheme(thm)">

           <!-- <div class="form-group col-md-12">
               <label for="">                   
               </label>
           </div>  -->

<div class="form-group col-md-12" style="margin: 0;margin-bottom: 5px;">
   <button class="btn btn-primary form-control" style="border: 0;" :style="{backgroundColor: thm.value}"> {{ thm.name }} (Apply Theme) </button>
</div>



            </form>



         </span> 


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

<!-- add update section -->

  </span>



</template>

<script>
export default {

    data(){
         
         return {
            themes:[
                {
                    name:'Blue (Default)',
                    value:'#1459ff'
                },
                {
                    name:'Dark Knight',
                    value:'#000'
                },
                {
                    name:'Pnk',
                    value:'rgb(255, 20, 248)'
                },                
                {
                    name:'Rose',
                    value:'#ff0000'
                }

            ],
            selectedTheme:{
                name:'',
                value:''
            }    
         }

    },

    mounted(){
      
    },
    

    methods: {
        //change-user-theme/
      saveTheme(selectedTheme){
          fetch(baseURL + 'change-user-theme/' + authUser,{
              method:'PUT',
              body:JSON.stringify(selectedTheme),
              headers:{
                  'content-Type':'application/json'
              }
          })
          .then(res=>res.json())
          .then(res=>{
             this.scanResponse(res);
             location.reload();
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
