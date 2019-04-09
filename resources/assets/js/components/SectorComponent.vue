<template>
  
  <div class="row">

<!-- comment modal start -->
<div class="modal fade" id="sectorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> {{ edit? 'Edit Sector':'Add Sector' }} </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form @submit.prevent="saveSector">
      <div class="modal-body">

          <div class="container">
              <div class="row">

        <div class="col-md-12">


           <div class="form-group col-md-12">
               <label for="">
                   Sector
               </label>
               <input placeholder="Sector Name" class="form-control" v-model="sector.name" />
           </div>  

           <div style="clear: both;"></div> 


        </div>

              </div>
          </div>
        

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary"> {{ edit? 'Save' : 'Add Sector' }} </button>
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

  <a @click.prevent="doAdd" href="#" class="btn btn-sm btn-info" data-target="#sectorModal" data-toggle="modal">Add Sector</a>

</div>


       <h4>Manage Sectors</h4>

        <div class="col-xs-12">


        </div>
    
        
        <table class="table table-striped">

            <tr>
                <th>
                    Name
                </th>
                <th></th>
            </tr>

            <tr v-for="sector in sectors" v-bind:key="sector.id">
               <td>
                   {{ sector.name }}
               </td>
               <td>
                   <!-- sectorModal -->
                   <a data-target="#sectorModal" data-toggle="modal" href="" @click.prevent="linktoForm(sector)" class="btn btn-sm btn-warning">Edit</a>
                   <a href="" @click.prevent="removeSector(sector)" class="btn btn-sm btn-danger">Remove</a>
               </td>
            </tr>


        </table>

<nav aria-label="Page navigation example">
  <ul class="pagination pagination-sm">
    <li v-bind:class="[{disabled: !pagination.prev}]" class="page-item">
        <a @click.prevent="fetchSectors(pagination.prev)" class="page-link" href="#">Previous</a>
    </li>
    <li class="page-item disabled"><a class="page-link">Page {{ pagination.current }} of  {{ pagination.total }}</a></li>
    <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>-->
    <li class="page-item" v-bind:class="[{disabled: !pagination.next}]"> 
        <a @click.prevent="fetchSectors(pagination.next)" class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>


           </div>
       </div>



     </div>



<!-- add update section -->

  </div>



</template>

<script>
export default {

    data(){
         
         return {
            sectors:[],
            sector:{
                name:'New Sector.'
            },
            cacheUrl:'',
            edit:false,
            id:'',
            error:'',
            status:'',
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
      this.fetchSectors();
    },

    methods: {
        doAdd(){
           this.edit = false;  
        },

        hideForm(){
            // $('#form').slideUp();
            $('.modal').trigger('click');
            this.toggle = true;
            //  this.resetForm();
        },

        makePagination(meta,links){
           
           this.pagination.first = links.first;
           this.pagination.last = links.last;
           this.pagination.prev = links.prev;
           this.pagination.next = links.next;
           this.pagination.current = meta.current_page;
           this.pagination.total = meta.last_page;   

        },

        fetchSectors(url){
           this.statusBusy('Loading ...');  
            let api = '';
            if (url){
             api = url;
             this.cacheUrl = api;
            }else{
             api = baseURL + 'sector'; 
             if (!this.cacheUrl){
               this.cacheUrl = api;
             }
             api = this.cacheUrl;  
            }

            fetch(api)
            .then(res=>res.json())
            .then(res=>{

                this.sectors = res.data;
                this.statusBusy('');  
                this.makePagination(res.meta,res.links);


            })
            .catch(e=>console.log(e));

        },

        linktoForm(sector){
          
           this.id = sector.id;
           this.sector.name = sector.name;
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


        saveSector(){
             
             if (this.edit === true){ //update
    
               this.statusBusy('Loading ...');  
               
               fetch(baseURL + 'sector/' + this.id,{
                    
                    method:'PUT',
                    body:JSON.stringify(this.sector),
                    headers:{
                        'content-Type':'application/json'
                    }

                }).then(res=>res.json())
                .then(res=>{
                    this.scanResponse(res);  
                    this.statusBusy('');                        
                    this.edit = false;
                    this.fetchSectors();
                    this.hideForm(); 
                })
                .then(data=>{
                    this.sector.name = '';
                })
                .catch(e=>console.log(e));

             }else{ //create
               
              if (this.sector.name === ''){
                  
                this.error = '1px solid red';

              }else{

                this.error = '';
   
               this.statusBusy('Loading ...');  


                fetch(baseURL + 'sector',{
                    
                    method:'POST',
                    body:JSON.stringify(this.sector),
                    headers:{
                        'content-Type':'application/json'
                    }

                }).then(res=>res.json())
                .then(res=>{
                    
                    this.scanResponse(res);                      
                    this.edit = false;
                    this.fetchSectors();
                    this.hideForm();

                })
                .then(data=>{
                    this.sector.name = '';
                    this.statusBusy('');  
                })
                .catch(e=>{
                      this.statusBusy(e);  
                });


              } 

             }

        },

        removeSector(sector){
          if (confirm('You you want to confirm this action?')){
           this.statusBusy('Loading ...');  
           fetch(baseURL + 'sector/' + sector.id,{
               method:'DELETE',
               headers:{
                   'content-Type':'application/json'
               }
           })
           .then(res=>res.json())
           .then(res=>{
              this.fetchSectors();
              this.statusBusy('');
           })
           .catch(e=>{
            this.statusBusy(e);  
           }); 
          }  
        },

        statusBusy(msg){
         this.status = msg;
        }

    }
    
}
</script>
