<template>
  
  <div class="row">

<!-- comment modal start -->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> {{ edit? 'Edit Category':'Add Category' }} </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form @submit.prevent="saveCategory">
      <div class="modal-body">

          <div class="container">
              <div class="row">

        <div class="col-md-12">


           <div class="form-group col-md-12">
               <label for="">
                   Category
               </label>
               <input placeholder="Category Name" class="form-control" v-model="category.name" />
           </div>  

           <div style="clear: both;"></div> 


        </div>

              </div>
          </div>
        

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary"> {{ edit? 'Save' : 'Add Category' }} </button>
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

  <a @click.prevent="doAdd" href="#" class="btn btn-sm btn-info" data-target="#commentModal" data-toggle="modal">Add Category</a>

</div>

       <h4>Manage Categories</h4>

        <div class="col-xs-12">


        </div>
    
        
        <table class="table table-striped">

            <tr>
                <th>
                    Name
                </th>
                <th></th>
            </tr>

            <tr v-for="category in categories" v-bind:key="category.id">
               <td>
                   {{ category.name }}
               </td>
               <td>
                   <a  data-target="#commentModal" data-toggle="modal" href="" @click.prevent="linktoForm(category)" class="btn btn-sm btn-warning">Edit</a>
                   <a href="" @click.prevent="removeCategory(category)" class="btn btn-sm btn-danger">Remove</a>
               </td>
            </tr>


        </table>


<nav aria-label="Page navigation example">
  <ul class="pagination pagination-sm">
    <li v-bind:class="[{disabled: !pagination.prev}]" class="page-item">
        <a @click.prevent="fetchCategories(pagination.prev)" class="page-link" href="#">Previous</a>
    </li>
    <li class="page-item disabled"><a class="page-link">Page {{ pagination.current }} of  {{ pagination.total }}</a></li>
    <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>-->
    <li class="page-item" v-bind:class="[{disabled: !pagination.next}]"> 
        <a @click.prevent="fetchCategories(pagination.next)" class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>


           </div>



       </div>



     </div>





  </div>



</template>

<script>
export default {

    data(){
         
         return {
            categories:[],
            category:{
                name:'New Category.'
            },
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
      this.fetchCategories();
    },

    methods: {

        doAdd(){
           this.edit = false;  
        },
        makePagination(meta,links){
           
           this.pagination.first = links.first;
           this.pagination.last = links.last;
           this.pagination.prev = links.prev;
           this.pagination.next = links.next;
           this.pagination.current = meta.current_page;
           this.pagination.total = meta.last_page;   

        },
        fetchCategories(url){
           this.statusBusy('Loading ...');  
            let api = '';
            if (url){
             api = url;
            }else{
             api = baseURL + 'category';   
            }

            // console.log(url,api);


            fetch(api)
            .then(res=>res.json())
            .then(res=>{

                this.categories = res.data;
                this.statusBusy('');  
                this.makePagination(res.meta,res.links);

            })
            .catch(e=>console.log(e));

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

        linktoForm(category){
          
           this.id = category.id;
           this.category.name = category.name;
           this.edit = true;

        },

        hideForm(){
            // $('#form').slideUp();
            $('.modal').trigger('click');
            this.toggle = true;
            //  this.resetForm();
        },

        saveCategory(){
             
             if (this.edit === true){ //update
    
               this.statusBusy('Loading ...');  
               
               fetch(baseURL + 'category/' + this.id,{
                    
                    method:'PUT',
                    body:JSON.stringify(this.category),
                    headers:{
                        'content-Type':'application/json'
                    }

                }).then(res=>res.json())
                .then(res=>{
                      
                    this.statusBusy('');                        
                    this.edit = false;
                    this.scanResponse(res);
                    this.hideForm();
                    this.fetchCategories();

                })
                .then(data=>{
                    this.category.name = '';
                })
                .catch(e=>console.log(e));

             }else{ //create
               
              if (this.category.name === ''){
                  
                this.error = '1px solid red';

              }else{

                this.error = '';
   
               this.statusBusy('Loading ...');  


                fetch(baseURL + 'category',{
                    
                    method:'POST',
                    body:JSON.stringify(this.category),
                    headers:{
                        'content-Type':'application/json'
                    }

                }).then(res=>res.json())
                .then(res=>{
                    this.scanResponse(res);                    
                    this.edit = false;
                    this.fetchCategories();
                    this.hideForm();

                })
                .then(data=>{
                    this.category.name = '';
                    this.statusBusy('');  
                })
                .catch(e=>{
                      this.statusBusy(e);  
                });


              } 

             }

        },

        removeCategory(category){
          if (confirm('You you want to confirm this action?')){
           this.statusBusy('Loading ...');  
           fetch(baseURL + 'category/' + category.id,{
               method:'DELETE',
               headers:{
                   'content-Type':'application/json'
               }
           })
           .then(res=>res.json())
           .then(res=>{
              this.fetchCategories();
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
