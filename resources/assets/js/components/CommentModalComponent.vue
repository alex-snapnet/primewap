<template>
  
  <span>

<!-- comment thread section start -->

<div class="modal fade" id="commentThreadModal"  role="dialog"  >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comments</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span >&times;</span>
        </button>
      </div>

     <div>
       <!-- content start -->
       <comment :agro_id="id" :user_id="data.user_id"></comment>
       <!-- content stop -->
     </div>


    </div>
  </div>
</div>

<!-- comment thread section stop -->

  </span>

</template>

<script>
// import SectorMixin from './mixins';
export default {
    
    props:[
        'id',
        'data'
    ],
    watch:{
        id(n,o){
        //    alert(n+n);
        }
    },
    data(){
       return {
           jQ:$
       }
    },
    methods:{}    
}
</script>