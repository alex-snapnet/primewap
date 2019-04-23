<template>
  
  <span>

<!-- report modal start -->
<div class="modal fade" id="reportModal"  role="dialog"  >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Milestone</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span >&times;</span>
        </button>
      </div>

      <form @submit.prevent="$emit('addReport');busy=true;">
      <div class="modal-body">

          <div class="container">
              <div class="row">

        <div class="col-md-12">


           <div class="form-group col-md-12">
               <label for="">
                   Milestone
               </label>
               <input type="text" class="form-control" v-model="reportData.report" placeholder="Milestone"/>
           </div>  

           <div style="clear: both;"></div> 

           <!-- <div class="form-group col-md-12">
               <label for="">
                   Status
               </label>

               <select class="form-control" v-model="reportData.status">
                   <option value="Prospect">Prospect</option>
                   <option value="Purchase">Purchase</option>
                   <option value="Pipeline">Pipeline</option>
                   <option value="Prospect">Prospect</option>
                   <option value="Present">Present</option>
               </select>
           </div>   -->

           <div style="clear: both;"></div> 


           <!-- <div class="form-group col-md-12">

               <label for="">
                 Progress Status
               </label>
            
              <input type="number" class="form-control" placeholder="Progress" v-model="reportData.prog_status" />

           </div>   -->


           <div style="clear: both;"></div> 


        </div>

              </div>
          </div>
        

         <!-- <div class="col-md-12" style="border-top: 1px solid #aaa;padding-top: 11px;">
           <div align="right" class="col-md-12">
                <button class="btn btn-sm btn-success">{{ text }}</button>
           </div>
         </div> -->


      </div>

      <div class="modal-footer">

       <img v-show="busy" src="/images/loader.gif" style="height: 45px;"/>


        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary">Post Milestone</button>
      </div>

      </form>


    </div>
  </div>
</div>
<!-- report modal stop -->

  </span>

</template>

<script>
// import SectorMixin from './mixins';
export default {
    
    props:[
        'reportData'
    ],
    data(){
       return {
           jQ:$,
           busy:false
       }
    },
    mounted(){
       this.$root.$on('fetchFinish',()=>{
           this.busy = false;
       }); 
    },
    methods:{}    
}
</script>