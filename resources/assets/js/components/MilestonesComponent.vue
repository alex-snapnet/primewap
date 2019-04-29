<template>
 <span>

<!-- comment modal start -->
<div class="modal fade" :id="'milestonesListModal' + comp_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Milestones ({{ count }})</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
 <!-- content start -->

<!-- start -->
<div class="col-lg-12" style="padding: 0;">
      <div class="card">
          <div class="card-body" style="padding-left: 7px;padding-right: 7px;padding: 0;">


<div class="col-lg-12">
    <!-- <h4><u>Milestones </u> -->
    
<!-- <img src="/images/loader.gif" style="height: 45px;"/> -->
    
    <!-- </h4> -->
</div>


         <form @submit.prevent="save">

           <div class="form-group col-md-12">
               <input placeholder="Milestone" class="form-control" v-model="data.report" />
           </div>  

           <div class="form-group col-md-12">
               <input placeholder="Hint" class="form-control" v-model="data.notes" />
           </div>  


<div class="form-group col-md-12" style="margin: 0;">
   <button class="btn btn-sm btn-outline-primary"> {{ edit? 'Save' : 'Add Milestone' }} </button>
   
   <button v-show="edit" @click.prevent="edit = false;resetForm();" class="btn btn-sm btn-outline-warning">Cancel</button>
</div>



            </form>
      

        <div class="col-xs-12" style="padding-top: 20px;height: 300px;overflow-y: scroll;/* border: 1px solid #bbb; */background-color: #eee;margin-top: 10px;border-radius: 14px;margin-bottom: 10px;padding: 20px;">
             
             <div v-for="item in list" v-bind:key="item.id" style="
    border: 1px solid #bbb;
    padding: 7px;
    margin-bottom: 7px;
    box-shadow: 0 0 3px rgba(0,0,0,0.2);
">
               
               <div class="col-md-12">
                <b>#</b> {{ item.report }}
               </div>


               <div class="col-md-12" style="margin-top: 5px;">
                 <b>!</b>{{ item.notes }}
               </div>



               <div class="col-md-12" align="right">

                     <a href="" @click.prevent="linktoForm(item)" class="btn btn-sm btn-outline-warning btn-icon">
                       <i class="fa fa-pencil"></i>
                     </a>
                   <a href="" @click.prevent="removeMileStone(item)" class="btn btn-sm btn-outline-danger btn-icon">
                     <i class="fa fa-times"></i>
                   </a>


               </div>


              <form @submit.prevent="markAsCompleted(item)">
              
              
               <div class="col-md-12">
                 <label>Done? <input type="checkbox" :checked="+item.done == 1" v-model="item.done"/> </label>
               </div>

               <div class="col-md-12" v-show="+item.done == 1">
                 <input class="form-control" placeholder="Notes" type="text" v-model="item.additional_notes" style="margin-bottom: 5px;"/>
               </div>

               <div class="col-md-12" v-show="+item.done == 1">
                 <button class="btn btn-sm btn-outline-warning">Mark As Completed</button>
               </div>

               </form>



               <div class="col-md-6 box" align="right" style="
    text-align: left;
    color: #aaa;
">
                Created: <small>{{ item.created_at | ago }} </small><br />
               </div>

               <div class="col-md-6 box" align="right" style="
    text-align: right;
    color: #aaa;
">
                Last Updated: <small>{{ item.updated_at | ago }}</small>
               </div>

              <div style="clear: both;"></div>

               <div class="col-md-12" align="right" style="
    text-align: left;
    color: #aaa;
">
                <b>Executed By <small>{{ item.user.email? item.user.email : "?" }}</small></b>
               </div>



               <div style="clear: both;">&nbsp;</div>

             </div>

        </div>


          </div>
      </div>

</div>
<!-- stop -->

<!-- start -->

<div class="col-lg-12">
<nav aria-label="Page navigation example">
  <ul class="pagination pagination-sm">
    <li v-bind:class="[{disabled: !pagination.prev}]" class="page-item">
        <a @click.prevent="fetchMileStones(pagination.prev)" class="page-link" href="#">
          <i class="fa fa-angle-left"></i>
        </a>
    </li>
    <li class="page-item disabled"><a class="page-link">Page {{ pagination.current }} of  {{ pagination.total }}</a></li>
    <li class="page-item" v-bind:class="[{disabled: !pagination.next}]"> 
        <a @click.prevent="fetchMileStones(pagination.next)" class="page-link" href="#">
          <i class="fa fa-angle-right"></i>
        </a>
    </li>
  </ul>
</nav>
</div>

<!-- stop -->

<!-- content stop -->
      </div>




    </div>
  </div>
</div>
<!-- comment modal stop -->


<!-- link start -->

                 <a @click.prevent="init" href="" style="
color: rgb(255, 255, 255);background-color: rgb(0, 0, 0);padding: 4px;border-radius: 50%;display: inline-block;text-align: center;
"  class="count-indicator" :data-target="'#milestonesListModal' + comp_id" data-toggle="modal">
                  <span class="count">{{ count?  count.toLocaleString() : 0 }}</span>
                 </a>  


<!-- link stop -->
 </span>
</template>
<script>
export default {

    props:[
      'comp_id',
      'count',
      'agro_id',
      'user_id' //report
    ],
   
    data(){
       return {
         edit:false,
         data:{
            notes:'',
            report:''
         },
         taskReply:{
           done:false,
           additional_notes:''
         },
         id:'',
         list:[],
         pagination:{}
       };
    },

    filters:{
       ago(value){
          return moment(new Date(value)).fromNow();
       }
    },
    

    watch:{
      
      agro_id(n,o){
        // alert('called..');
      }

    },

    mounted(){
      //  alert('Agro-ID:' + this.agro_id);    

      this.$root.$on('openMilestone',(id)=>{
         //milestonesListModal
         if (id == this.comp_id){
            $('#milestonesListModal' + id).modal();
         }
      });

    },

    methods:{
       
       init(){
          this.fetchMileStones();           
       },

        makePagination(meta,links){
           
           this.pagination.first = links.first;
           this.pagination.last = links.last;
           this.pagination.prev = links.prev;
           this.pagination.next = links.next;
           this.pagination.current = meta.current_page;
           this.pagination.total = meta.last_page;   

        },

      fetchMileStones(url){
         if (!url){
            url = baseURL + 'report?agro_id=' + this.agro_id;
         }else{
            url = url + '&agro_id = ' + this.agro_id;
         }


          fetch(url,{
            method:'GET'
          }).then(res=>res.json())
            .then(res=>{
                this.list = res.data;
                this.makePagination(res.meta,res.links);
                
            });
      },
      save(){
        toastr.success('Saving ... ');
         if (this.edit){
           this.updateMileStone();
         }else{
           this.addMileStone();
         }
         this.edit = false;
      },
      addMileStone(){
         fetch(baseURL + 'report' + '?user_id=' + authUser,{
           method:'POST',
           headers:{
             'content-Type':'application/json'
           },
           body:JSON.stringify({
             report:this.data.report,
             notes:this.data.notes,
             user_id:this.user_id,
             agro_id:this.agro_id
           })
         }).then(res=>res.json()).then(res=>{
           this.fetchMileStones();
           this.scanResponse(res);
           this.resetForm();
           this.$root.$emit('fetchAgrolytic');
         });
      },
      updateMileStone(){
         fetch(baseURL + 'report/' + this.id,{
           method:'PUT',
           headers:{
             'content-Type':'application/json'
           },
           body:JSON.stringify({
             report:this.data.report,
             notes:this.data.notes
           })
         }).then(res=>res.json()).then(res=>{
           this.fetchMileStones();
           this.scanResponse(res);
           this.resetForm();
           this.$root.$emit('fetchAgrolytic');
         });
      },
      removeMileStone(data){
        if (confirm('Do you want to confirm this action?')){
         fetch(baseURL + 'report/' + data.id,{
           method:'DELETE',
           headers:{
             'content-Type':'application/json'
           }
         }).then(res=>res.json()).then(res=>{
           this.scanResponse(res);
           this.fetchMileStones();
         });
        }
      },
      resetForm(){
        this.data.report = '';
        this.data.notes = '';
      },
      linktoForm(data){
          this.data.report = data.report;
          this.edit = true;
          this.data.notes = data.notes;
          this.id = data.id;
      },
      linktoFormForReply(data){
         this.taskReply.done = true;
         this.taskReply.additional_notes = data.additional_notes;
      },
      markAsCompleted(data){
        toastr.success('Saving Status ...');
          fetch(baseURL + 'report/' + data.id + '?user_id=' + this.user_id,{
           method:'PUT',
           headers:{
             'content-Type':'application/json'
           },
           body:JSON.stringify({
             done:data.done,
             additional_notes:data.additional_notes,
             user_id:this.user_id
           })
         }).then(res=>res.json()).then(res=>{
           this.fetchMileStones();
           this.scanResponse(res);
           this.resetForm();
           this.$root.$emit('fetchAgrolytic'); //wicked code.
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