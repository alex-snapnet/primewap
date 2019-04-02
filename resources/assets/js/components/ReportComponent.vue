<template>
  
  <div class="row">


<!-- modal start -->

<!-- report modal start -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Report {{ preview? 'Preview' : '' }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form @submit.prevent="saveReport">
      <div class="modal-body">

          <div class="container">
              <div class="row">

        <div class="col-md-12">


           <div class="form-group col-md-12">
               <label for="">
                   Report
               </label>
               <textarea class="form-control" id="" cols="30" rows="10" v-model="reportData.report"></textarea>
           </div>  

           <div style="clear: both;"></div> 

           <div class="form-group col-md-12">
               <label for="">
                   Status
               </label>

               <select class="form-control" v-model="reportData.status">
                   <option value="Prospect">Prospect</option>
                   <option value="Perpetual">Perpetual</option>
               </select>
           </div>  

           <div style="clear: both;"></div> 


           <div class="form-group col-md-12">

               <label for="">
                 Progress Status
               </label>
            
              <input type="text" class="form-control" placeholder="Progress" v-model="reportData.prog_status" />

           </div>  


           <div style="clear: both;"></div> 



        </div>

              </div>
          </div>
        

         <!-- <div class="col-md-12" style="border-top: 1px solid #aaa;padding-top: 11px;">
           <div align="right" class="col-md-12">
                <button class="btn btn-sm btn-success">{{ text }}</button>
           </div>
         </div> -->


      </div>

      <div class="modal-footer" v-show="!preview">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary"> {{ edit? 'Save' : 'Post Report' }} </button>
      </div>

      </form>


    </div>
  </div>
</div>
<!-- report modal stop -->
    

<!-- add update section -->
<div class="col-lg-12">


 <div align="right">
     
     <!-- <a v-show="toggle" id="form-btn" href="" class="btn btn-sm btn-info mb-2" @click.prevent="showForm" >Add / Save Agrolytic</a> -->

<span class="pull-left" style="float: left;font-size: 18px;text-decoration: underline;">
    Manage Reports
</span>

    <export-csv v-bind:data="list"></export-csv>     

     <a data-toggle="modal" data-target="#agrolyticModal" id="form-btn" href="#" class="btn btn-sm btn-warning mb-2" >Import Excel Document</a>

     <a  :href="getCurrentPageUrl()" class="btn btn-sm btn-success mb-2" >Reset Filter</a>

     <a v-show="canModify" @click="addReport" data-toggle="modal" data-target="#reportModal" id="form-btn" href="#" class="btn btn-sm btn-success mb-2" >Add Report</a>
 
 </div>

     <!-- [end] -->


     </div>
     <!-- add update section -->

     
     <div class="col-lg-12">
       
       <div class="card">
           <div class="card-body">

        <div class="col-xs-12" style="height: 20px;" v-show="status">
             <img src="/images/loader.gif" style="height: 20px;"/>    
        </div>

       <h4>

             <span style="display: inline-block;">
                <b style="font-size: 14px;color: #777;">Date From:.</b><br />  
               <input v-model="dateFrom" type="date" placeholder="Date From" style="border: 1px solid #ddd;font-size: 14px;padding: 7px;"/>
             </span>

             <span style="display: inline-block;">
                <b style="font-size: 14px;;color: #777;">Date To:.</b><br />  
               <input v-model="dateTo" type="date" placeholder="Date To" style="border: 1px solid #ddd;font-size: 14px;padding: 7px;"/>
             </span> 



             <button class="btn btn-sm btn-info" @click.prevent="fetchReports()">Filter</button>

       </h4>

        <div class="col-xs-12">

        </div>
    
        
        <table class="table table-stripped">

            <tr>
                
                <!-- <th>
                    Objective
                </th> -->
                
                
                <th>
                    Report
                </th>
                <th>
                    User
                </th>
                <th>
                    Status
                </th>
                <th>
                    Progress
                </th>
                <th>
                    Created
                </th>
                <th></th>
            </tr>

            <tbody>

            <tr v-for="data_ in list" v-bind:key="data_.id">

               <!-- <td style="width: 67px;">
                  {{ data_.pag_objective }}
               </td> -->

               <td>
                   {{ data_.report }}
               </td>
               <td>
                   {{ data_.user.name }}
               </td>
               <td>
                   {{ data_.status }}
               </td>
               <td>

    <progress-bar :value=" ( data_.prog_status === 'Pending' )? 0 : +data_.prog_status " />                   
                
               </td>
               <td>
                   {{ data_.created_at }}
               </td>
               <td align="right">


<!-- Example split danger button -->

<div class="btn-group">
  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
  </button>
  <div class="dropdown-menu">



    <!-- preview button -->
    <a  href="" @click.prevent="doPreview(data_)" class="dropdown-item"  data-toggle="modal" data-target="#reportModal">Preview</a>
    <div class="dropdown-divider"></div>


    <!-- edit button -->
    <a v-show="canModify"  href="" @click.prevent="linktoForm(data_)" class="dropdown-item"  data-toggle="modal" data-target="#reportModal">Edit</a>
    <div class="dropdown-divider"></div>
    

    <!-- remove -->
    <a v-show="canModify" @click.prevent="doRemove(data_)" href=""  class="dropdown-item">Remove</a>
    <div class="dropdown-divider"></div>
    

<!-- /manage-agrolytic -->
  </div>
</div>



               </td>
            </tr>

            </tbody>


        </table>

<nav aria-label="Page navigation example">
  <ul class="pagination pagination-sm">
    <li v-bind:class="[{disabled: !pagination.prev}]" class="page-item">
        <a @click.prevent="fetchReports(pagination.prev)" class="page-link" href="#">Previous</a>
    </li>
    <li class="page-item disabled"><a class="page-link">Page {{ pagination.current }} of  {{ pagination.total }}</a></li>
    <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>-->
    <li class="page-item" v-bind:class="[{disabled: !pagination.next}]"> 
        <a @click.prevent="fetchReports(pagination.next)" class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>


           </div>
       </div>



     </div>




 




  </div>



</template>

<script>
// import SectorMixin from './mixins';


export default {
    
    mixins:[SectorMixin],

    props:[
      'user_id',
      'role',
      'agro_id'
    ],

    data(){
         
         return {
            preview:false, 
            canModify:false,
            csvData:[],
            agrolytic:[],
            dateFrom:'',
            dateTo:'',
            filterCat:'',
            filterSec:'',
            list:[],
            reportFetchApiCache:'',
            reportData:{
                report:'',
                user_id:authUser,
                agro_id:'',
                status:'Perpetual',
                prog_status:'100'
            },
            users:[],
            customers:[],
            apis:{
               baseUrl:'http://127.0.0.1:8000/api/',  
               readApi:'http://127.0.0.1:8000/api/report',  
               createApi:'http://127.0.0.1:8000/api/report',
               updateApi:'http://127.0.0.1:8000/api/report/',
               deleteApi:'http://127.0.0.1:8000/api/report/'
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
            },
            filters:[]

         }

    },

    mounted(){
    //   this.handleFilters(); //this handles scoping  
      this.fetchReports();
      this.fetchAgrolytic();
    },

    methods: {

        getCurrentPageUrl(){
           return '/manage-report/' + this.agro_id;
        },

        fetchAgrolytic(){
           fetch(this.apis.baseUrl + 'agrolytic/' + this.agro_id,{
               method:'Get'
           })
           .then(res=>res.json())
           .then(res=>{
               this.agrolytic = res.data;
               if (this.user_id == this.agrolytic.op_rep){
                 this.canModify = true;
               }else{
                 this.canModify = false;  
               }
           });
        },
        
        handleFilters(){

        //    if (this.isAdminOnly()){
        //       this.filters.push('user_id=' + this.user_id);
        //    }
        //    if (this.isPrimeOspOnly()){
        //       this.filters.push('op_rep=' + this.user_id);
        //    }
        //    if (this.cat_id){
        //       this.filters.push('cat_id=' + this.cat_id);     
        //    }
        //    if (this.sec_id){
        //       this.filters.push('sec_id=' + this.sec_id);
        //    }

           if (this.dateFrom){
              this.filters.push('date_from=' + this.dateFrom);
           }
           if (this.dateTo){
              this.filters.push('date_to=' + this.dateTo);
           }

           this.filters.push('agro_id=' + this.agro_id);

           console.log(this.filters);

        },

        isAdminOnly(){
          return this.role == 'prime_admin';
        },

        isPrimeOspOnly(){
          return this.role == 'prime_osp';
        },

        isAdmin(agrolytic){
           return (this.role == 'prime_admin' && this.user_id == agrolytic.user_id);
        },

        isPrimeOsp(agrolytic){
          return (this.role == 'prime_osp' && agrolytic.op_rep == this.user_id); 
        },
           
        makePagination(meta,links){
           
           this.pagination.first = links.first;
           this.pagination.last = links.last;
           this.pagination.prev = links.prev;
           this.pagination.next = links.next;
           this.pagination.current = meta.current_page;
           this.pagination.total = meta.last_page;   

        },

        hideForm(){
            // $('#form').slideUp();
            $('.modal').trigger('click');
            // this.toggle = true;
            this.resetForm();
        },

        fetchReports(url){
           this.handleFilters(); 
           this.statusBusy(true);  
            let api = '';
            if (url){
            //  api = url;
             this.reportFetchApiCache = url + '&' + this.filters.join('&');
             api = this.reportFetchApiCache;
            }else{
              if (!this.reportFetchApiCache){
                 this.reportFetchApiCache = this.apis.readApi; 
              }
             api = this.reportFetchApiCache + '?' + this.filters.join('&');  //this.apis.readApi;   
            }

            // console.log(api);

            fetch(api)
            .then(res=>res.json())
            .then(res=>{

                this.list = res.data;
                this.statusBusy(false);  
                this.makePagination(res.meta,res.links);
                this.filters = []; //reset the filter.


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

        addReport(){
          this.resetForm();
        },

        resetForm(){

            this.edit = false;
            this.reportData.report = '';
            // this.user_id:authUser;
            // agro_id:'',
            this.reportData.status = 'Perpetual';
            this.reportData.prog_status = '100';
         
        },

        doCreate(){

            this.statusBusy(true);  

                fetch(this.apis.createApi,{
                    
                    method:'POST',
                    body:JSON.stringify(this.reportData),
                    headers:{
                        'content-Type':'application/json'
                    }

                }).then(res=>res.json())
                .then(res=>{
                    
                    this.edit = false;
                    this.fetchReports();
                    this.hideForm();
                    this.scanResponse(res);

                })
                .then(data=>{
                    // this.sector.name = '';
                    this.statusBusy(false);  
                    this.resetForm();
                })
                .catch(e=>{
                   console.log(e);  
                });

                this.text = 'Create';
        },

        doSave(){
               this.statusBusy(true);
               fetch(this.apis.updateApi + this.id,{
                    
                    method:'PUT',
                    body:JSON.stringify(this.reportData),
                    headers:{
                        'content-Type':'application/json'
                    }

                }).then(res=>res.json())
                .then(res=>{
                      
                    this.statusBusy(false);                        
                    this.edit = false;
                    this.fetchReports();
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

        doRemove(data){
          if (confirm('You you want to confirm this action?')){
           this.statusBusy(true);  
           fetch(this.apis.deleteApi + data.id,{
               method:'DELETE',
               headers:{
                   'content-Type':'application/json'
               }
           })
           .then(res=>res.json())
           .then(res=>{
              this.fetchReports();
              this.statusBusy(false);
              this.scanResponse(res);
           })
           .catch(e=>{
            // this.statusBusy(e);
            console.log(e);  
           }); 
          }  
        },

        scrollToTop(){
          $('html, body').animate({ 
            scrollTop: $('#form-btn').offset().top 
            }, 1000);
        },

        doPreview(data){
          this.linktoForm(data);
          this.preview = true;
        },

        linktoForm(data){

            this.reportData.report = data.report;
            this.id = data.id;
            this.edit = true;
            // this.user_id:authUser;
            // agro_id:'',
            this.reportData.status = data.status;
            this.reportData.prog_status = data.prog_status;
            this.preview = false;

        },
        
        saveReport(){
             
             this.reportData.agro_id = this.agro_id;
             this.reportData.user_id = this.user_id;

             if (this.edit === true){ //update
                this.doSave();
                this.edit = false;
             }else{ //create
                this.doCreate();
             }

        },

        removeReport(data){
            this.doRemove(data); 
        },

        statusBusy(stat){
         this.status = stat;
        }

    }
    
}
</script>