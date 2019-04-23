<template>
  
  <span>

<!-- comment modal start -->
<div class="modal fade" id="groupModal11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="color: #000;">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> {{ edit? 'Edit Group':'Add Group' }} </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      
      <div class="modal-body">

          <div class="container">
              <div class="row">

        <div class="col-md-12">

<form @submit.prevent="saveGroup">
           <div class="form-group col-md-12">
               <label for="">
                   Group Name
               </label>
               <input placeholder="Group Name" class="form-control" v-model="group.name" />
           </div>  

           <div class="form-group col-md-12">
               <button class="btn btn-primary"> {{ edit? 'Save' : 'Add Group' }} </button>

   <button v-show="edit" @click.prevent="edit = false;group.name = ''" class="btn btn-warning">Cancel</button>

           </div>
</form>
           <div style="clear: both;"></div> 




<!-- content start -->

     <div class="col-lg-12">
       
       <div class="card">
           <div class="card-body">

        <div class="col-xs-12" style="height: 20px;">
             {{ status }}
        </div>


<div class="col-xs-12" align="right" style="margin-bottom: 12px;">

  <export-csv :excelStyle="{'margin-bottom':'0 !important'}" v-bind:data="groups"></export-csv>     

  <!-- importGroupModal -->

 <excel-import  @batchCreated="batchCreateNotificationAndReload" :compId="23" :apiBatchCreate="batchCreate"></excel-import>
  <!-- <a @click.prevent="doAdd" href="#" class="btn btn-sm btn-info" data-target="#importGroupModal" data-toggle="modal">Import Group</a> -->

</div>

       <h4>Manage Groups &nbsp;
           <span v-if="hasPrevHistory()">
              ( {{ currentParent.name }} )
           </span>
       </h4>

        <div class="col-xs-12 mb-2" align="right">
  
  <a v-show="hasPrevHistory()" @click.prevent="popHistory" href="" class="btn btn-sm btn-info">Back</a>

        </div>
    
    <div class="col-xs-12">


        <div class="col-xs-12">
             
             <div v-for="group in groups" v-bind:key="group.id">
               
               <div class="col-md-6">
                 {{ group.name }}
               </div>

               <div class="col-md-6" align="right">

                   <a href="" @click.prevent="linktoForm(group)" class="btn btn-sm btn-outline-warning">Edit</a>
                   
                   <a href="" @click.prevent="removeGroup(group)" class="btn btn-sm btn-outline-danger">Remove</a>

               </div>

               <div style="clear: both;">&nbsp;</div>

             </div>


        </div>


    </div>
        



<nav aria-label="Page navigation example">
  <ul class="pagination pagination-sm">
    <li v-bind:class="[{disabled: !pagination.prev}]" class="page-item">
        <a @click.prevent="fetchGroups(pagination.prev)" class="page-link" href="#">Previous</a>
    </li>
    <li class="page-item disabled"><a class="page-link">Page {{ pagination.current }} of  {{ pagination.total }}</a></li>
    <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>-->
    <li class="page-item" v-bind:class="[{disabled: !pagination.next}]"> 
        <a @click.prevent="fetchGroups(pagination.next)" class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>


           </div>



       </div>



     </div>


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


          <li class="nav-item">
            <a href="#" class="nav-link" data-target="#groupModal11" data-toggle="modal">
              <i class="fa fa-check-circle"></i>Groups</a>
          </li>


  </span>



</template>

<script>
export default {

    data(){
         
         return {
            groups:[],
            batchCreate:baseURL + 'groupname-batch-create',
            grp:'',
            parentHistory:[],
            currentParent:null,
            group:{
                name:'New Group.',
                group_name_id:''
            },
            edit:false,
            id:'',
            error:'',
            status:'',
            group_name_id:'0',
            group_parent:'0',
            pagination:{
                prev:'',
                next:'',
                first:'',
                last:'',
                current:'',
                total:''
            }
         }

    },

    mounted(){
      this.fetchGroups();
    },

    methods: {

        batchCreateNotificationAndReload(){
            toastr.success('Batch Created Successfully ...');
            this.fetchGroups();  
        }, 

        hideForm(){
            // $('#form').slideUp();
            // $('.modal').trigger('click');
            // this.toggle = true;
            //  this.resetForm();
        },

        doAdd(){
           this.edit = false;  
        },

        hasPrevHistory(){
        //  console.log((this.parentHistory.length > 0));
         return (this.parentHistory.length > 0);
        },

        pushHistory(obj){
         this.parentHistory.push(obj);
        },

        popHistory(){
         var obj = this.parentHistory.pop(); 
        //  console.log(obj);
         this.group_name_id = obj.group_name_id;
         this.fetchGroups();
        //  if (this.parentHistory.length - 1)
           this.currentParent = this.parentHistory[this.parentHistory.length - 1];
        },

        makePagination(meta,links){
           
           this.pagination.first = links.first;
           this.pagination.last = links.last;
           this.pagination.prev = links.prev;
           this.pagination.next = links.next;
           this.pagination.current = meta.current_page;
           this.pagination.total = meta.last_page;   

        },
        fetchGroups(url){
           this.statusBusy('Loading ...');  
            let api = '';
            // + '&group_name_id=' + this.group_name_id
            if (url){
             api = url;
            }else{
             api = baseURL + 'groupname'
            }

            // console.log(url,api);

            fetch(api)
            .then(res=>res.json())
            .then(res=>{

                this.groups = res.data;
                this.statusBusy('');  
                this.makePagination(res.meta,res.links);

            })
            .catch(e=>console.log(e));

        },

        linktoForm(group){
          
           this.id = group.id;
           this.group.name = group.name;
           this.edit = true;

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
        },


        doSave(){
               this.statusBusy('Loading ...');  
               
               fetch(baseURL + 'groupname/' + this.id + '?user_id=' + authUser,{
                    
                    method:'PUT',
                    body:JSON.stringify(this.group),
                    headers:{
                        'content-Type':'application/json'
                    }

                }).then(res=>res.json())
                .then(res=>{
                      
                    this.statusBusy('');                        
                    this.edit = false;
                    this.fetchGroups();
                    this.scanResponse(res);
                    this.hideForm();


                })
                .then(data=>{
                    this.group.name = '';
                })
                .catch(e=>console.log(e));
        },

        doCreate(){
               this.statusBusy('Loading ...');  

               this.group.group_name_id = this.group_name_id;


                fetch(baseURL + 'groupname' + '?user_id=' + authUser,{
                    
                    method:'POST',
                    body:JSON.stringify(this.group),
                    headers:{
                        'content-Type':'application/json'
                    }

                }).then(res=>res.json())
                .then(res=>{
                    
                    this.edit = false;
                    this.fetchGroups();
                    this.scanResponse(res);
                    this.hideForm();

                })
                .then(data=>{
                    this.group.name = '';
                    this.statusBusy('');  
                })
                .catch(e=>{
                      this.statusBusy(e);  
                });
        },
        
        saveGroup(){
             
             if (this.edit === true){ //update
    
                this.doSave();

             }else{ //create
               
              if (this.group.name === ''){
                  
                this.error = '1px solid red';

              }else{

                this.error = '';
   
                this.doCreate();

              } 

             }

        },

        removeGroup(group){
          if (confirm('You you want to confirm this action?')){
           this.statusBusy('Loading ...');  
           fetch(baseURL + 'groupname/' + group.id + '?user_id=' + authUser,{
               method:'DELETE',
               headers:{
                   'content-Type':'application/json'
               }
           })
           .then(res=>res.json())
           .then(res=>{
              this.fetchGroups();
              this.statusBusy('');
              this.scanResponse(res);

           })
           .catch(e=>{
            this.statusBusy(e);  
           }); 
          }  
        },

        selectSub(group){
          this.group_name_id = group.id;
          this.group_parent = group.group_name_id;
          this.pushHistory(group);
          this.currentParent = group;
          this.fetchGroups();
        },

        statusBusy(msg){
         this.status = msg;
        }

    }
    
}
</script>


<style scoped>
 .page-link{
   color: #000 !important;
 }
</style>