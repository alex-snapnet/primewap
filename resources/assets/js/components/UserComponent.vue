<template>
  
  <span>


<!-- comment modal start -->
<div class="modal fade" id="userAccountModal11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #000;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> {{ edit? 'Edit User':'Add User' }} </h5>
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

        <form @submit.prevent="saveUser">

           <div class="form-group" style="margin-bottom: 0;">
              <label>Full Name</label>
            </div> 
  
           <div class="form-group">
              <input v-bind:style="{border: error}" type="text" class="form-control" placeholder="Full Name" v-model="data.name" />    
           </div>  


           <div class="form-group" style="margin-bottom: 0;">
              <label>E-mail</label>
            </div> 

           <div class="form-group">
              <input v-bind:style="{border: error}" type="text" class="form-control" placeholder="E-mail" v-model="data.email" />    
           </div>  

           <div class="form-group" style="margin-bottom: 0;">
              <label>Password</label>
            </div> 

           <div class="form-group">
              <input v-bind:style="{border: error}" type="password" class="form-control" placeholder="Password" v-model="data.password" />    
           </div>  


           <div class="form-group" style="margin-bottom: 0;">
              <label>Confirm Password</label>
            </div> 

           <div class="form-group">
              <input v-bind:style="{border: error}" type="password" class="form-control" placeholder="Password Confirm" v-model="data.password_confirm" />    
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
                <th>Role</th>
                <th></th>
            </tr>

            <tr v-for="data_ in list" v-bind:key="data_.id">
               <td>
                   {{ data_.name }}
               </td>
               <td>
                   {{ data_.email }}
               </td>
               <td>
                   {{ data_.type }}
               </td>
               <td>




<div class="dropdown">
    <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-sm btn-outline-info btn-secondary dropdown-toggle">
    Actions
   </button> 
   <div aria-labelledby="dropdownMenuButton" class="dropdown-menu" style="position: absolute;">
        <a href="" @click.prevent="linktoForm(data_)" class="dropdown-item">Edit</a>
        <a href="" @click.prevent="makePrimeAdmin(data_)"  class="dropdown-item">Make Prime-Admin</a>
        <a href="" @click.prevent="makePrimeOsp(data_)"  class="dropdown-item">Make Prime-Osp</a>
        <a href="" @click.prevent="makePrimeSuperAdmin(data_)"  class="dropdown-item">Make Prime-Super Admin</a>
        
        
    </div>
</div>



               </td>
            </tr>


        </table>



<nav aria-label="Page navigation example">
  <ul class="pagination pagination-sm">
    <li v-bind:class="[{disabled: !pagination.prev}]" class="page-item">
        <a @click.prevent="fetchUsers(pagination.prev)" class="page-link" href="#">Previous</a>
    </li>
    <li class="page-item disabled"><a class="page-link">Page {{ pagination.current }} of  {{ pagination.total }}</a></li>
    <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>-->
    <li class="page-item" v-bind:class="[{disabled: !pagination.next}]"> 
        <a @click.prevent="fetchUsers(pagination.next)" class="page-link" href="#">Next</a>
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

<!-- link section  -->
          <li class="nav-item">
            <a href="#" class="nav-link" data-target="#userAccountModal11" data-toggle="modal">
              <i class="fa fa-check-circle"></i>Accounts</a>
          </li>
<!-- link section -->

  </span>



</template>

<script>
export default {

    data(){
         
         return {
            list:[],
            fetchAPI:'',
            data:{
                name:'',
                email:'',
                password:'',
                password_confirm:''
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
      this.fetchUsers();
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
            // $('#form').slideUp();
            // this.toggle = true;
            this.resetForm();
        },

        showForm(){
            // $('#form').slideDown();
            this.toggle = false;
        },

        fetchUsers(url){
           this.statusBusy('Loading ...');  
            // let api = '';
            if (url){
             this.fetchAPI = url;
            }else if (!this.fetchAPI){
             this.fetchAPI = baseURL + 'user';   
            }

            fetch(this.fetchAPI)
            .then(res=>res.json())
            .then(res=>{

                this.list = res.data;
                this.statusBusy('');  
                this.makePagination(res.meta,res.links);


            })
            .catch(e=>console.log(e));

        },

        resetForm(){
            this.data.name = '';
            this.data.email = '';
            this.data.password = '';
            this.data.password_confirm = '';
        },

        doCreate(){

            this.statusBusy('Loading ...');  

                fetch(baseURL + 'user' + '?user_id=' + authUser,{
                    
                    method:'POST',
                    body:JSON.stringify(this.data),
                    headers:{
                        'content-Type':'application/json'
                    }

                }).then(res=>res.json())
                .then(res=>{
                    
                    this.edit = false;
                    this.fetchUsers();
                    this.hideForm();
                    this.scanResponse(res);

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

        makePrimeAdmin(data){
           fetch(baseURL + 'change-user-role/' + data.id + '?user_id=' + authUser,{
               method:'PUT',
               body:JSON.stringify({type:'prime_admin'}),
               headers:{
                   'content-Type':'application/json'
               }
           })
           .then(res=>res.json())
           .then(res=>{
              this.scanResponse(res);
              this.fetchUsers();
           })
           .catch(e=>{
               this.scanResponse(e);
           });
        },
//prime_super_admin

        makePrimeSuperAdmin(data){
           fetch(baseURL + 'change-user-role/' + data.id + '?user_id=' + authUser,{
               method:'PUT',
               body:JSON.stringify({type:'prime_super_admin'}),
               headers:{
                   'content-Type':'application/json'
               }
           })
           .then(res=>res.json())
           .then(res=>{
              this.scanResponse(res);
              this.fetchUsers();
           })
           .catch(e=>{
               this.scanResponse(e);
           });
        },


        makePrimeOsp(data){
           fetch(baseURL + 'change-user-role/' + data.id + '?user_id=' + authUser,{
               method:'PUT',
               body:JSON.stringify({type:'prime_osp'}),
               headers:{
                   'content-Type':'application/json'
               }
           })
           .then(res=>res.json())
           .then(res=>{
              this.scanResponse(res);
              this.fetchUsers();
           })
           .catch(e=>{
               this.scanResponse(e);
           });
        },

        doSave(){
               fetch(baseURL + 'change-user-name/' + this.id + '?user_id=' + authUser,{
                    
                    method:'PUT',
                    body:JSON.stringify(this.data),
                    headers:{
                        'content-Type':'application/json'
                    }

                }).then(res=>res.json())
                .then(res=>{
                      
                    this.statusBusy('');                        
                    this.edit = false;
                    this.fetchUsers();
                    this.hideForm();
                    this.scanResponse(res);

                })
                .then(data=>{
                    // this.customer.name = '';
                    this.resetForm();

                })
                .catch(e=>console.log(e));

                this.text = 'Create';

        },

        // doRemove(customer){
        //   if (confirm('You you want to confirm this action?')){
        //    this.statusBusy('Loading ...');  
        //    fetch('api/customer/' + customer.id,{
        //        method:'DELETE',
        //        headers:{
        //            'content-Type':'application/json'
        //        }
        //    })
        //    .then(res=>res.json())
        //    .then(res=>{
        //       this.fetchCustomers();
        //       this.statusBusy('');
        //    })
        //    .catch(e=>{
        //     this.statusBusy(e);  
        //    }); 
        //   }  
        // },

        scrollToTop(){
          $('html, body').animate({ 
            scrollTop: $('#form-btn').offset().top 
            }, 1000);
        },

        linktoForm(data_){

            this.data.name = data_.name;
            this.data.email = data_.email;

            this.text = 'Save';
            this.id = data_.id;
            this.edit = true;

            this.showForm();
            this.scrollToTop();

        },
        
        saveUser(){
             
             if (this.edit === true){ //update
                this.doSave();
             }else{ //create
                this.doCreate();
             }

        },

        removeUser(data_){
            // this.doRemove(customer); 
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