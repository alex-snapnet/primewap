<template>
  
  <span>


<!-- comment modal start -->
<div class="modal fade" id="customerModal11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #000;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> {{ edit? 'Edit Customer':'Add Customer' }} </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

          <div class="container">
              <div class="row">

        <div class="col-md-12" style="padding: 0;">

            <!-- col-1 -->
            <div class="col-md-3 box">

        <form @submit.prevent="saveSector">

           <div class="form-group">
              <input v-bind:style="{border: error}" type="text" class="form-control" placeholder="Customer Name" v-model="customer.name" />    
           </div>  


           <div class="form-group">
              <input v-bind:style="{border: error}" type="text" class="form-control" placeholder="Contact E-mail" v-model="customer.contact_email" />    
           </div>  


           <div class="form-group">
              <input v-bind:style="{border: error}" type="text" class="form-control" placeholder="Address" v-model="customer.address" />    
           </div>  

           <div class="form-group">
              <input v-bind:style="{border: error}" type="text" class="form-control" placeholder="Phone Number" v-model="customer.phone_num" />    
           </div>  



<div class="form-group">
   <button class="btn btn-sm btn-outline-primary"> {{ edit? 'Save' : 'Add User' }} </button>
   <button v-show="edit" @click.prevent="edit = false;resetForm()" class="btn btn-sm btn-outline-warning">Cancel</button>
</div>



        </form>

            </div>
            <!-- col-1 -->

            <!-- col-2 -->
            <div class="col-md-9 box">


<!-- table content here .     -->

        <table class="table table-striped" style="border: 1px solid rgb(20, 89, 255);margin-bottom: 5px;">

            <tr>
                <th>
                    Name
                </th>
                <th>
                    Contact E-mail
                </th>

                <th>
                    Phone
                </th>

                <th></th>
                
                
            </tr>

            <tr v-for="data_ in customers" v-bind:key="data_.id">
               <td>
                   {{ data_.name }}
               </td>
               <td>
                   {{ data_.contact_email }}
               </td>

               <td>
                   {{ data_.phone_num }}
               </td>

               <td>



<div class="dropdown">
    <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-sm btn-outline-info btn-secondary dropdown-toggle">
    Actions
   </button> 
   <div aria-labelledby="dropdownMenuButton" class="dropdown-menu" style="position: absolute;">
        
        <a href="" @click.prevent="linktoForm(data_)" class="dropdown-item">Edit</a>
        
        <a href="" @click.prevent="removeCustomer(data_)" class="dropdown-item">Remove</a>                
    </div>
</div>



               </td>
            </tr>


        </table>



<nav aria-label="Page navigation example">
  <ul class="pagination pagination-sm">
    <li v-bind:class="[{disabled: !pagination.prev}]" class="page-item">
        <a @click.prevent="fetchCustomers(pagination.prev)" class="page-link" href="#">
            <i class="fa fa-angle-left"></i>
        </a>
    </li>
    <li class="page-item disabled"><a class="page-link">Page {{ pagination.current }} of  {{ pagination.total }}</a></li>
    <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>-->
    <li class="page-item" v-bind:class="[{disabled: !pagination.next}]"> 
        <a @click.prevent="fetchCustomers(pagination.next)" class="page-link" href="#">
            <i class="fa fa-angle-right"></i>
        </a>
    </li>
  </ul>
</nav>

            </div>
            <!-- col-2 -->



<!-- content start -->

<!-- table content stop  -->


<!-- content stop -->

        </div>

              </div>
          </div>
        

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Close</button>
      </div>

     


    </div>
  </div>
</div>



<!-- comment modal stop -->





          <li class="nav-item">
            <a href="#" class="nav-link" data-target="#customerModal11" data-toggle="modal">
              <i class="fa fa-check-circle"></i>Company</a>
          </li>





  </span>



</template>

<script>
export default {

    data(){
         
         return {
            customers:[],
            customer:{
                name:'',
                contact_email:'',
                address:'',
                phone_num:'',
                added_by:authUser
            },
            edit:false,
            id:'',
            error:'',
            status:'',
            text:'Create',
            toggle: true,
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
      this.fetchCustomers();
    },

    methods: {

        makePagination(meta,links){
           
           this.pagination.first = links.first;
           this.pagination.last = links.last;
           this.pagination.prev = links.prev;
           this.pagination.next = links.next;
           this.pagination.current = meta.current_page;
           this.pagination.total = meta.last_page;   

        },

        toggleFormShowHide(){
            
            if (this.toggle){
              this.showForm();
            }else{
              this.hideForm();
            }
            // this.toggle = !this.toggle;

        },

        hideForm(){
            $('#form').slideUp();
            this.toggle = true;
            this.resetForm();
        },

        showForm(){
            $('#form').slideDown();
            this.toggle = false;
        },

        fetchCustomers(url){
           this.statusBusy('Loading ...');  
            let api = '';
            if (url){
             api = url;
            }else{
             api = baseURL + 'customer';   
            }

            fetch(api)
            .then(res=>res.json())
            .then(res=>{

                this.customers = res.data;
                this.statusBusy('');  
                this.makePagination(res.meta,res.links);


            })
            .catch(e=>console.log(e));

        },

        resetForm(){
            this.customer.name = '';
            this.customer.contact_email = '';
            this.customer.address = '';
            this.customer.phone_num = '';
            this.customer.added_by = authUser;       
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

        doCreate(){

            this.statusBusy('Loading ...');  

                fetch(baseURL + 'customer' + '?user_id=' + authUser,{
                    
                    method:'POST',
                    body:JSON.stringify(this.customer),
                    headers:{
                        'content-Type':'application/json'
                    }

                }).then(res=>res.json())
                .then(res=>{
                    
                    this.edit = false;
                    this.scanResponse(res);
                    this.fetchCustomers();
                    this.hideForm();

                })
                .then(data=>{
                    // this.sector.name = '';
                    this.statusBusy('');  
                    this.resetForm();
                })
                .catch(e=>{
                      this.statusBusy(e);  
                });

                this.text = 'Create';
        },

        doSave(){
               fetch(baseURL + 'customer/' + this.id + '?user_id=' + authUser,{
                    
                    method:'PUT',
                    body:JSON.stringify(this.customer),
                    headers:{
                        'content-Type':'application/json'
                    }

                }).then(res=>res.json())
                .then(res=>{

                    this.scanResponse(res);                      
                    this.statusBusy('');                        
                    this.edit = false;
                    this.fetchCustomers();
                    this.hideForm();

                })
                .then(data=>{
                    // this.customer.name = '';
                    this.resetForm();

                })
                .catch(e=>console.log(e));

                this.text = 'Create';

        },

        doRemove(customer){
          if (confirm('You you want to confirm this action?')){
           this.statusBusy('Loading ...');  
           fetch(baseURL + 'customer/' + customer.id + '?user_id=' + authUser,{
               method:'DELETE',
               headers:{
                   'content-Type':'application/json'
               }
           })
           .then(res=>res.json())
           .then(res=>{
              this.scanResponse(res);
              this.fetchCustomers();
              this.statusBusy('');
           })
           .catch(e=>{
            this.statusBusy(e);  
           }); 
          }  
        },

        scrollToTop(){
          $('html, body').animate({ 
            scrollTop: $('#form-btn').offset().top 
            }, 1000);
        },

        linktoForm(customer){

            this.customer.name = customer.name;
            this.customer.contact_email = customer.contact_email;
            this.customer.address = customer.address;
            this.customer.phone_num = customer.phone_num;
            this.edit = true;
            this.id = customer.id;
            // this.added_by = authUser;       
            this.text = 'Save';
            this.showForm();
            this.scrollToTop();

        },
        
        saveSector(){
             
             if (this.edit === true){ //update
                this.doSave();
             }else{ //create
                this.doCreate();
             }

        },

        removeCustomer(customer){
            this.doRemove(customer); 
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
