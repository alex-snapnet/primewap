<template>
  
  <span>

<!-- comment modal start -->
<div class="modal fade" id="commentModal"  role="dialog"  >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span >&times;</span>
        </button>
      </div>

      <form @submit.prevent="$emit('addComment');busy=true;">
      <div class="modal-body">

          <div class="container">
              <div class="row">

        <div class="col-md-12">


           <div class="form-group col-md-12">
               <label for="">
                   Comment
               </label>
               <input placeholder="Your comment" class="form-control"  v-model="commentData.comment" />
           </div>  

           <div style="clear: both;"></div> 


        </div>

              </div>
          </div>
        

      </div>

      <div class="modal-footer">

        <img v-show="busy" src="/images/loader.gif" style="height: 45px;"/> 

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary">Post Comment</button>
      </div>

      </form>


    </div>
  </div>
</div>
<!-- comment modal stop -->

  </span>

</template>

<script>
// import SectorMixin from './mixins';
export default {
    
    props:[
        'commentData'
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