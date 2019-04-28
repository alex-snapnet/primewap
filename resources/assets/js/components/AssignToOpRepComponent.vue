<template>
  
  <span>

<!-- Modal -->
<div class="modal fade" id="assignOpRepModal"  role="dialog"  >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign To Operation - Rep.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span >&times;</span>
        </button>
      </div>

      <form @submit.prevent="assignToOpRep">
      <div class="modal-body">

          <div class="container">
              <div class="row">

        <div class="col-xs-12">


           <div class="form-group col-md-12">
                       <op-rep-input :text="email" @opRepChange="(value)=>{data.op_rep = value;}" :op_rep="op_rep"></op-rep-input>
           </div>  



        </div>

              </div>
          </div>
        

      </div>

      <div class="modal-footer">

<img v-show="busy" src="/images/loader.gif" style="height: 45px;"/>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary">Assign</button>
      </div>

      </form>


    </div>
  </div>
</div>

<!-- modal stop -->

  </span>

</template>

<script>
// import SectorMixin from './mixins';
export default {
    
    props:[
        'agro_id',
        'op_rep',
        'email'
    ],
    data(){
       return {
           jQ:$,
           busy:false,
           data:{
               op_rep:''
           }
       }
    },
    mounted(){
    //   this.$root.$on('fetchFinish',()=>{
    //     this.busy = false;    
    //   });
    },
    methods:{
        assignToOpRep(){
            this.busy = true;
            fetch(baseURL + 'agrolytic/assign-to-oprep/' + this.agro_id + '?user_id=' + authUser,{
                method:'POST',
                body:JSON.stringify({
                    op_rep:this.data.op_rep
                }),
                headers:{
                    'content-Type':'application/json'
                }
            }).then(res=>{
              this.busy = false;
              this.$root.$emit('fetchAgrolytic'); //wicked code.
              this.hideForm();
            }).catch(err=>{
                console.log(err);
            });
        },
        hideForm(){
            $('.modal').trigger('click');
        }
    }    
}
</script>