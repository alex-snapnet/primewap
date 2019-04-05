<template>
  
  <div class="row">






<!-- comment modal start -->
<div class="modal fade" id="groupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> {{ edit? 'Edit Group':'Add Group' }} </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form @submit.prevent="saveGroup">
      <div class="modal-body">

          <div class="container">
              <div class="row">

        <div class="col-md-12">


           <div class="form-group col-md-12">
               <label for="">
                   Group Name
               </label>
               <input placeholder="Group Name" class="form-control" v-model="group.name" />
           </div>  

           <div style="clear: both;"></div> 


        </div>

              </div>
          </div>
        

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary"> {{ edit? 'Save' : 'Add Group' }} </button>
      </div>

      </form>


    </div>
  </div>
</div>

<!-- comment modal stop -->


     
     <div class="col-lg-12">
       
       <div class="card">
           <div class="card-body">



        <div class="col-xs-12" style="height: 20px;">
             {{ status }}
        </div>


<div class="col-xs-12" align="right">

  <export-csv :excelStyle="{'margin-bottom':'0 !important'}" v-bind:data="groups"></export-csv>     

  <!-- importGroupModal -->

 <excel-import  @batchCreated="batchCreateNotificationAndReload" :compId="23" :apiBatchCreate="'http://127.0.0.1:8000/api/groupname-batch-create'"></excel-import>
  <!-- <a @click.prevent="doAdd" href="#" class="btn btn-sm btn-info" data-target="#importGroupModal" data-toggle="modal">Import Group</a> -->

  <a @click.prevent="doAdd" href="#" class="btn btn-sm btn-info" data-target="#groupModal" data-toggle="modal">Add Group</a>

</div>


       <h4>Manage Groups &nbsp;
           <span v-if="hasPrevHistory()">
              ( {{ currentParent.name }} )
           </span>
       </h4>

        <div class="col-xs-12 mb-2" align="right">
  
  <a v-show="hasPrevHistory()" @click.prevent="popHistory" href="" class="btn btn-sm btn-info">Back</a>

        </div>
    
        
        <table class="table table-striped">

            <tr>
                <th>
                    Name
                </th>
                <th></th>
            </tr>

            <tr v-for="group in groups" v-bind:key="group.id">
               <td>
                   {{ group.name }}
               </td>
               <td>



<!-- Jamie Foxx Interviews Gabrielle Union -- OFF SCR -->

<!-- <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown button
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
</div> -->

<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Actions
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

    <a href="#" @click.prevent="linktoForm(group)" data-target="#groupModal" data-toggle="modal" class="dropdown-item">Edit</a>
    <!-- <a href="" @click.prevent="selectSub(group)" class="dropdown-item">View Sub Group</a> -->
    <a href="" @click.prevent="removeGroup(group)" class="dropdown-item">Remove</a>

    <!-- <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a> -->

  </div>
</div>



                   <!-- <a href="" @click.prevent="linktoForm(group)" class="btn btn-sm btn-warning">Edit</a>
                   <a href="" @click.prevent="selectSub(group)" class="btn btn-sm btn-info">Sub</a>
                   <a href="" @click.prevent="removeGroup(group)" class="btn btn-sm btn-danger">Remove</a> -->






               </td>
            </tr>


        </table>





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



<!-- excel-to-json -->


  </div>



</template>

<script>
export default {

    data(){
         
         return {
            groups:[],
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
            $('.modal').trigger('click');
            this.toggle = true;
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
             api = 'api/groupname'
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
               
               fetch('api/groupname/' + this.id,{
                    
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


                fetch('api/groupname',{
                    
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
           fetch('api/groupname/' + group.id,{
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
