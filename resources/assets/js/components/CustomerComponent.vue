<template>
  
  <div class="row">



<!-- add update section -->
     <div class="col-lg-12">

 <div align="right">
    
     <a v-show="toggle" id="form-btn" href="" class="btn btn-sm btn-info mb-2" @click.prevent="showForm" >Add / Save Customer</a>

     <a v-show="!toggle" id="form-btn" href="" class="btn btn-sm btn-danger mb-2" @click.prevent="hideForm" >Close</a>
 
 </div>

       <div class="card mb-2" id="form" style="display: none;">
           <div class="card-body">


       <h4>Add/Save Customer Data</h4>

        <div class="col-xs-12">
        </div>
    
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


           <div align="right">
                <button class="btn btn-sm btn-success">{{ text }}</button>
           </div>


        </form>



           </div>
       </div>



     </div>
     <!-- add update section -->

     
     <div class="col-lg-12">
       
       <div class="card">
           <div class="card-body">

        <div class="col-xs-12" style="height: 20px;">
             {{ status }}
        </div>


       <h4>Manage Customers</h4>

        <div class="col-xs-12">


        </div>
    
        
        <table class="table table-striped">

            <tr>
                <th>
                    Name
                </th>
                <th>
                    Contact E-mail
                </th>
                <th></th>
            </tr>

            <tr v-for="customer in customers" v-bind:key="customer.id">
               <td>
                   {{ customer.name }}
               </td>
               <td>
                   {{ customer.contact_email }}
               </td>
               <td>
                   <a href="" @click.prevent="linktoForm(customer)" class="btn btn-sm btn-warning">Edit</a>
                   <a href="" @click.prevent="removeCustomer(customer)" class="btn btn-sm btn-danger">Remove</a>
               </td>
            </tr>


        </table>

<nav aria-label="Page navigation example">
  <ul class="pagination pagination-sm">
    <li v-bind:class="[{disabled: !pagination.prev}]" class="page-item">
        <a @click.prevent="fetchCustomers(pagination.prev)" class="page-link" href="#">Previous</a>
    </li>
    <li class="page-item disabled"><a class="page-link">Page {{ pagination.current }} of  {{ pagination.total }}</a></li>
    <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>-->
    <li class="page-item" v-bind:class="[{disabled: !pagination.next}]"> 
        <a @click.prevent="fetchCustomers(pagination.next)" class="page-link" href="#">Next</a>
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

                fetch(baseURL + 'customer',{
                    
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
               fetch(baseURL + 'customer/' + this.id,{
                    
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
           fetch(baseURL + 'customer/' + customer.id,{
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
