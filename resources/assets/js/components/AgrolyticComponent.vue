<template>
  
  <div class="row">


<!-- modal start -->


<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->





<!-- comment thread section start -->

<div class="modal fade" id="commentThreadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comments</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

     <div>
       <!-- content start -->
       <comment :agro_id="id" :user_id="data.user_id"></comment>
       <!-- content stop -->
     </div>


    </div>
  </div>
</div>

<!-- comment thread section stop -->

<!-- comment modal start -->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form @submit.prevent="addComment">
      <div class="modal-body">

          <div class="container">
              <div class="row">

        <div class="col-md-12">


           <div class="form-group col-md-12">
               <label for="">
                   Comment
               </label>
               <input placeholder="Your comment" class="form-control"  v-model="commentData.comment" />
           </div>  

           <div style="clear: both;"></div> 


        </div>

              </div>
          </div>
        

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary">Post Comment</button>
      </div>

      </form>


    </div>
  </div>
</div>
<!-- comment modal stop -->

<!-- report modal start -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form @submit.prevent="addReport">
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
                   <option value="Purchase">Purchase</option>
                   <option value="Pipeline">Pipeline</option>
                   <option value="Prospect">Prospect</option>
                   <option value="Present">Present</option>
               </select>
           </div>  

           <div style="clear: both;"></div> 


           <div class="form-group col-md-12">

               <label for="">
                 Progress Status
               </label>
            
              <input type="number" class="form-control" placeholder="Progress" v-model="reportData.prog_status" />

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

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary">Post Report</button>
      </div>

      </form>


    </div>
  </div>
</div>
<!-- report modal stop -->


<!-- Modal -->
<div class="modal fade" id="agrolyticModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agrolytic {{ preview? 'Preview' : '' }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form @submit.prevent="saveAgrolytic">
      <div class="modal-body">

          <div class="container">
              <div class="row">

        <div class="col-xs-12">


           <div class="form-group">
               <!-- {{ data.group_name_id }} -->
             <!-- <group-select v-model="data.group_name_id"></group-select> -->
           </div>  

           <div class="form-group col-md-6">
               <label for="">
                   Select Group
               </label>

               <select class="form-control" v-model="data.group_name_id">
                   <option value="0">--Select Group--</option>
                   <option v-for="group in groups" v-bind:value="group.id" v-bind:key="group.id">
                       {{ group.name }}
                   </option>
               </select>
           </div>  



           <div class="form-group col-md-6">
               <label for="">
                   Customer / Client
               </label>
               <select class="form-control" v-model="data.customer_id">
                   <option value="">--Select Customer--</option>
                   <option v-for="customer in customers" v-bind:key="customer.id" v-bind:value="customer.id">
                       {{ customer.name }}
                   </option>
               </select>
           </div>  

<div style="clear: both;"></div>

           <div class="form-group col-md-12">
               <label for="">
                   Category
               </label>

               <select class="form-control" v-model="data.cat_id">
                   <option value="">--Select Category--</option>
                   <option v-for="category in categories" v-bind:key="category.id" v-bind:value="category.id">
                       {{ category.name }}
                   </option>
               </select>
           </div>  

           <div style="clear: both;"></div> 

           <div class="form-group col-md-12">
               <label for="">
                   Sector
               </label>

               <select class="form-control" v-model="data.sec_id">
                   <option value="">--Select Sector--</option>
                   <option v-for="sector in sectors" v-bind:key="sector.id" v-bind:value="sector.id">
                       {{ sector.name }}
                   </option>
               </select>
           </div>  


           <div class="form-group col-md-12">
               <label for="">
                   Prospect
               </label>

              <input type="text" class="form-control" placeholder="Prospect" v-model="data.prospect" />    
           </div>  

          <hr class="clearfix" style="display: block;clear: both;"/>    


           <div class="form-group col-md-6">
               <label for="">
                   Company Objective
               </label>

              <input type="text" class="form-control" placeholder="Company Objective" v-model="data.comp_objective" />    
           </div>  

           <div class="form-group col-md-6">
               <label for="">
                   Pag Objective
               </label>

              <input type="text" class="form-control" placeholder="Pag Objective" v-model="data.pag_objective" />    
           </div>  

<div style="clear: both;"></div>

           <div class="form-group col-md-12">
               <label for="">
                   Initiative    
               </label>

              <input type="text" class="form-control" placeholder="Initiative" v-model="data.initiative" />    
           </div>  



           <div class="form-group col-md-6">
               <label for="">
                   Operations Representative
               </label>

               <select class="form-control" v-model="data.op_rep">
                   <option value="">--Select Operations Representative--</option>
                   <option v-for="user in users" v-bind:key="user.id" v-bind:value="user.id">
                       {{ user.name }}
                   </option>
               </select>
           </div>  

           <div class="form-group col-md-6">
               <label for="">
                   Status
               </label>


               <select class="form-control" v-model="data.status">
                   <option value="">--Select Status--</option>
                   <option value="Perpetual">Perpetual</option>
                   <option value="Prospect">Prospect</option>

               </select>
           </div>  


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
        <button class="btn btn-primary">{{ text }}</button>
      </div>

      </form>


    </div>
  </div>
</div>

<!-- modal stop -->

<div v-show="view !== 'agrolytic'" class="col-lg-12">
<div align="right">
     <a id="form-btn" href="" class="btn btn-sm btn-info mb-2" @click.prevent="backToAgrolytic" >Back To Agrolytic</a> 
</div>
</div>

<span class="col-lg-12" v-if="view === 'reports'">
  <!-- reports -->

</span>

<span class="col-lg-12" v-if="view === 'comments'">
   <!-- comments  -->
   <!-- <comment v-bind:agro_id="commentData.agro_id"></comment> -->
</span>

<span class="col-lg-12" v-else-if="view == 'agrolytic'" style="padding: 0;">
    

<!-- add update section -->
     <div class="col-lg-12">



     <!-- [end] -->


     </div>
     <!-- add update section -->

     
     <div class="col-lg-12">
       
       <div class="card">
           <div class="card-body table-responsive">



 <div align="right">
     
     <!-- <a v-show="toggle" id="form-btn" href="" class="btn btn-sm btn-info mb-2" @click.prevent="showForm" >Add / Save Agrolytic</a> -->

<span class="pull-left" style="float: left;font-size: 18px;text-decoration: underline;">
    Manage Agrolytic
</span>

<!-- <div class="btn-group" role="group" aria-label="Basic example"> -->

      <export-csv v-bind:data="list"></export-csv>     

     <a data-toggle="modal" data-target="#agrolyticModal" id="form-btn" href="#" class="btn btn-sm btn-warning mb-2" >Import Excel Document</a>

     <a  href="#" @click.prevent="resetFilters" class="btn btn-sm btn-success mb-2" >Reset Filter</a>

     <a v-show="isAdminOnly()" data-toggle="modal" data-target="#agrolyticModal" id="form-btn" href="#" class="btn btn-sm btn-success mb-2" >Add / Save Agrolytic</a>
 
<!-- </div> -->

 </div>







       <h4>

             <span style="display: inline-block;">
                <b style="font-size: 14px;color: #777;">Date From:.</b><br />  
               <input v-bind="dateFrom" type="date" placeholder="Date From" style="border: 1px solid #ddd;font-size: 14px;padding: 7px;"/>
             </span>

             <span style="display: inline-block;">
                <b style="font-size: 14px;;color: #777;">Date To:.</b><br />  
               <input v-bind="dateTo" type="date" placeholder="Date To" style="border: 1px solid #ddd;font-size: 14px;padding: 7px;"/>
             </span> 

             <span style="display: inline-block;">
                <b style="font-size: 14px;;color: #777;">Category:.</b><br />  
                <select v-model="cat_id" style="border: 1px solid #ddd;font-size: 13px;padding: 7px;">
                    <option value="">--Select Category--</option>
                    <option v-for="cat in categories" v-bind:value="cat.id" v-bind:key="cat.id">{{ cat.name }}</option>
                </select>
             </span>

             <span style="display: inline-block;">
                <b style="font-size: 14px;;color: #777;">Sector:.</b><br />  
                <select v-model="sec_id" style="border: 1px solid #ddd;font-size: 13px;padding: 7px;">
                    <option value="">--Select Sector--</option>
                    <option v-for="sec in sectors" v-bind:value="sec.id" v-bind:key="sec.id">{{ sec.name }}</option>
                </select>
             </span>


             <button @click.prevent="fetchAgrolytic()" class="btn btn-sm btn-info">Filter</button>

       </h4>

        <div class="col-xs-12">

        </div>
    
        
        <table class="table table-stripped">

            <tr>
                
                <!-- <th>
                    Objective
                </th> -->
                
                
                <th>
                    Customer/Client
                </th>
                <th>
                    Reports
                </th>
                <th>
                    Comments
                </th>
                <th>
                    Status
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
                   {{ data_.client_customer? data_.client_customer.name : 'N/A' }}
               </td>
               <td>
                   {{ data_.reports?  data_.reports.length.toLocaleString() : 0 }}
               </td>
               <td>
                   {{ data_.reports? data_.comments.length.toLocaleString() : 0 }}
               </td>
               <td>

                 <xprogress :label="'Progress'" :percentage = " ( data_.prog_status === 'Pending' )? 0 : +data_.prog_status "></xprogress>

    <!-- <progress-bar :value=" ( data_.prog_status === 'Pending' )? 0 : +data_.prog_status " />                    -->
                
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

    <!-- edit button -->
    <a v-show="isAdmin(data_)" href="" @click.prevent="linktoForm(data_)" class="dropdown-item"  data-toggle="modal" data-target="#agrolyticModal">Edit</a>
    <div class="dropdown-divider"></div>


    <!-- preview button -->
    <a  href="" @click.prevent="doPreview(data_)" class="dropdown-item"  data-toggle="modal" data-target="#agrolyticModal">Preview</a>
    <div class="dropdown-divider"></div>

    <!-- assign to op-rep -->
    <a v-show="isAdmin(data_)" href="" @click.prevent="linktoForm(data_)" class="dropdown-item"  data-toggle="modal" data-target="#agrolyticModal">Assign To Operation Rep.</a>
    <div class="dropdown-divider"></div>

    <!-- assign to third party -->
    <a v-show="isPrimeOsp(data_)" title="This is a temporal priviledge , should be used when on leave or not in access" href="" @click.prevent="linktoForm(data_)" class="dropdown-item" >Assign To Third Party.</a>
    <div class="dropdown-divider"></div>


    <!-- remove -->
    <a v-show="isAdmin(data_)" href="" @click.prevent="removeAgrolytic(data_)" class="dropdown-item">Remove</a>
    <div class="dropdown-divider"></div>
    
    <!-- add report -->
    <a v-show="isPrimeOsp(data_) || isAdmin(data_)" href="#" @click.prevent="selectAgrolyticRow(data_)" data-target="#reportModal" data-toggle="modal" class="dropdown-item">Add Report</a>
    <div class="dropdown-divider"></div>

    <!-- add comment -->
    <a v-show="isAdmin(data_)" href="" @click.prevent="selectAgrolyticRow(data_)" data-target="#commentModal" data-toggle="modal" class="dropdown-item">Add Comment</a>
    <div class="dropdown-divider"></div>

    <!-- view report -->
    <a target="_blank" :href="getReportLink(data_)" class="dropdown-item">View Reports</a>
    <div class="dropdown-divider"></div>

    <!-- view comments -->
    <!-- :href="getManageCommentLink(data_)" -->
    <a href="#" @click.prevent="linktoForm(data_)" data-target="#commentThreadModal" data-toggle="modal" class="dropdown-item">View Comments</a>

    <!-- category filter -->
    <div class="dropdown-divider"></div>
    <a v-show="isPrimeOsp(data_) || isAdmin(data_)" href="#" @click.prevent="setCategoryFilter(data_)" class="dropdown-item">Agrolytics In This Category</a>
<!-- :href="getCatFilter(data_)" -->

    <!-- sector filter -->
    <div class="dropdown-divider"></div>
    <a v-show="isPrimeOsp(data_) || isAdmin(data_)" href="#" @click.prevent="setSectorFilter(data_)" class="dropdown-item">Agrolytics In This Sector</a>
<!-- :href="getSecFilter(data_)" -->

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
        <a @click.prevent="fetchAgrolytic(pagination.prev)" class="page-link" href="#">Previous</a>
    </li>
    <li class="page-item disabled"><a class="page-link">Page {{ pagination.current }} of  {{ pagination.total }}</a></li>
    <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>-->
    <li class="page-item" v-bind:class="[{disabled: !pagination.next}]"> 
        <a @click.prevent="fetchAgrolytic(pagination.next)" class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>


        <div class="col-xs-12" style="height: 20px;" v-show="status" align="right">
             <img src="/images/loader.gif" style="height: 45px;"/>    
        </div>


           </div>
       </div>



     </div>




 


</span>

  </div>



</template>

<script>
// import SectorMixin from './mixins';


export default {
    
    mixins:[SectorMixin],

    props:[
      'user_id',
      'role',
      'date_days',
      'progress'
      // 'sec_id'
      // 'cat_id'
    ],

    data(){
         
         return {
            cat_id:'',
            sec_id:'',
            csvData:[],
            dateFrom:'',
            dateTo:'',
            filterCat:'',
            filterSec:'',
            preview:false,
            list:[],
            data:{
                group_name_id:'0',
                pag_objective:'',
                customer_id:'',
                cat_id:'',
                sec_id:'',
                prospect:'',
                comp_objective:'',
                initiative:'',
                user_id:authUser,
                op_rep:'',
                status:''

                // added_by:authUser
            },
            agrolyticFetchApiCache:'',
            reportData:{
                report:'',
                user_id:authUser,
                agro_id:'',
                status:'Perpetual',
                prog_status:'100'
            },
            commentData:{
              user_id:authUser,
              agro_id:'',
              comment:'Your comment here.'
            },
            view:'agrolytic',
            categories:[],
            sectors:[],
            groups:[],
            users:[],
            customers:[],
            apis:{
               readApi:baseURL + 'agrolytic',  
               createApi:baseURL+ 'agrolytic',
               updateApi:baseURL + 'agrolytic/',
               deleteApi:baseURL + 'agrolytic/'
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
      this.fetchAgrolytic();
      this.fetchCategories();
      this.fetchSectors();
      this.fetchOpReps();
      this.fetchCustomers();
      this.fetchGroups();
    },

    watch:{
        cat_id(newVal,oldVal){
          // this.handleFilters(); //this handles scoping  
          if (newVal){
             this.fetchAgrolytic();          
          }else{
             this.resetFilters();
             this.fetchAgrolytic();
          }
        },
        sec_id(newVal,oldVal){
          // this.handleFilters(); //this handles scoping  
          if (newVal){
            console.log(newVal);
            this.fetchAgrolytic();          
          }else{
            this.resetFilters(); 
            this.fetchAgrolytic();
          }
        }
    },

    methods: {

       resetFilters(){ ///
          this.cat_id = '';
          this.sec_id = ''; 
          console.log('called...');
       },

       setCategoryFilter(agrolytic){
          this.cat_id = agrolytic.cat_id;
       },
        
       setSectorFilter(agrolytic){
          this.sec_id = agrolytic.sec_id;
       },

        doPreview(data){
          this.linktoForm(data);
          this.preview = true;
        },
 
        getCatFilter(agrolytic){
           return '/manage-agrolytic?cat_id=' + agrolytic.cat_id;
        },

        getSecFilter(agrolytic){
           return '/manage-agrolytic?sec_id=' + agrolytic.sec_id;
        },
        
        handleFilters(){
           

           if (this.cat_id || this.sec_id){
              if (this.cat_id){
                  this.filters.push('cat_id=' + this.cat_id);     
              }
              if (this.sec_id){
                  this.filters.push('sec_id=' + this.sec_id);
              }
           }else{

              if (this.isAdminOnly()){
                  this.filters.push('user_id=' + this.user_id);
              }

              if (this.isPrimeOspOnly()){
                  this.filters.push('op_rep=' + this.user_id);
              }

           }

           if (this.dateFrom){
              this.filters.push('date_from=' + this.dateFrom);
           }
           if (this.dateTo){
              this.filters.push('date_to=' + this.dateTo);
           }

           if (this.date_days){
             this.filters.push('date_days=' + this.date_days);
           }

           if (this.progress !== null){ ///use double equal to (==)
             this.filters.push('progress=' + this.progress);
           }

          //  console.log(this.filters);

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
    
        getManageCommentLink(data){
         return '/manage-comment/' + data.id;
        },

        getReportLink(data){
          return '/manage-report/' + data.id;
        },

        showReport(agrolytic){
          this.view = 'reports';
          this.reportData.agro_id = agrolytic.id;
        },

        showComment(agrolytic){
          this.view = 'comments';
          this.commentData.agro_id = agrolytic.id;  
        },
         
        backToAgrolytic(){
           this.view = 'agrolytic';
        },

        fetchCategories(){
          fetch(baseURL + 'category')
          .then(res=>res.json())
          .then(res=>{
              this.categories = res.data;
          });
        },

        // fetchSectors(){
        //   fetch('api/sector')
        //   .then(res=>res.json())
        //   .then(res=>{
        //       this.sectors = res.data;
        //   });
        // },

        fetchCustomers(){
          fetch(baseURL + 'customer')
          .then(res=>res.json())
          .then(res=>{
              this.customers = res.data;
          });
        },


        fetchOpReps(){
          fetch(baseURL + 'user?role=prime_osp')
          .then(res=>res.json())
          .then(res=>{
              this.users = res.data;
          });
        },


        fetchGroups(){
          fetch(baseURL + 'groupname')
          .then(res=>res.json())
          .then(res=>{
              this.groups = res.data;
          });
        },


       selectAgrolyticRow(agrolyticData){
          this.reportData.agro_id = agrolyticData.id;
          this.commentData.agro_id = agrolyticData.id;
       }, 
       
        addReport(){
          fetch(baseURL + 'report',{
              method:'POST',
              body:JSON.stringify(this.reportData),
              headers:{
                  'content-Type':'application/json'
              }
          }).then(res=>res.json())
          .then(res=>{
             this.scanResponse(res);
             this.fetchAgrolytic();
             this.hideForm();

          }).catch(e=>console.log(e));

        },



        addComment(){
          fetch(baseURL + 'comment',{
              method:'POST',
              body:JSON.stringify(this.commentData),
              headers:{
                  'content-Type':'application/json'
              }
          }).then(res=>res.json())
          .then(res=>{
             this.scanResponse(res);
             this.hideForm();
             this.fetchAgrolytic();
          }).catch(e=>console.log(e));

        },


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
            $('.modal').trigger('click');
            this.toggle = true;
            this.resetForm();
        },

        showForm(){
            // $('#form').slideDown();
            // this.toggle = false;
        },

        fetchAgrolytic(url){
           
           this.handleFilters(); //this handles scoping  
           
           this.statusBusy(true);  
            let api = '';
            if (url){
            //  api = url;
             this.agrolyticFetchApiCache = url + '&' + this.filters.join('&');
             api = this.agrolyticFetchApiCache;
            }else{
              if (!this.agrolyticFetchApiCache){
                 this.agrolyticFetchApiCache = this.apis.readApi; 
              }
             api = this.agrolyticFetchApiCache + '?' + this.filters.join('&');  //this.apis.readApi;   
            }

            // console.log(api);

            fetch(api)
            .then(res=>res.json())
            .then(res=>{

                this.list = res.data;
                this.statusBusy(false);  
                this.makePagination(res.meta,res.links);
                this.filters = [];


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

        resetForm(){
         
            this.data.group_name_id = ''; //data.group_name_id;
            this.data.pag_objective = ''; //data.pag_objective;
            this.data.cat_id = ''; //data.cat_id;
            this.data.sec_id = ''; //data.sec_id;
            this.data.prospect = ''; //data.prospect;
            this.data.comp_objective = ''; //data.comp_objective;
            //this.data.group_name_id = ''; //data.group_name_id;
            this.data.customer_id = ''; //data.customer_id;
            this.data.status = ''; //data.status;
            this.data.op_rep = ''; //data.op_rep;

            //initiative
            this.data.initiative = '';
            this.edit = false;

            this.reportData.report = '';
            this.commentData.comment = '';

         
        },

        doCreate(){

            this.statusBusy(true);  

                fetch(this.apis.createApi,{
                    
                    method:'POST',
                    body:JSON.stringify(this.data),
                    headers:{
                        'content-Type':'application/json'
                    }

                }).then(res=>res.json())
                .then(res=>{
                    
                    this.edit = false;
                    this.fetchAgrolytic();
                    this.hideForm();
                    this.scanResponse(res);

                })
                .then(data=>{
                    // this.sector.name = '';
                    this.statusBusy(false);  
                    this.resetForm();
                })
                .catch(e=>{
                      this.statusBusy(e);  
                });

                this.text = 'Create';
        },

        doSave(){
               this.statusBusy(true);
               fetch(this.apis.updateApi + this.id,{
                    
                    method:'PUT',
                    body:JSON.stringify(this.data),
                    headers:{
                        'content-Type':'application/json'
                    }

                }).then(res=>res.json())
                .then(res=>{
                      
                    this.statusBusy(false);                        
                    this.edit = false;
                    this.fetchAgrolytic();
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
              this.fetchAgrolytic();
              this.statusBusy(false);
              this.scanResponse(res);
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

        linktoForm(data){

            this.data.group_name_id = data.group_name_id;
            this.data.pag_objective = data.pag_objective;
            this.data.cat_id = data.cat_id;
            this.data.sec_id = data.sec_id;
            this.data.prospect = data.prospect;
            this.data.comp_objective = data.comp_objective;
            // this.data.group_name_id = data.group_name_id;
            this.data.customer_id = data.customer_id;
            this.data.status = data.status;
            this.data.op_rep = data.op_rep;

            //initiative
            this.data.initiative = data.initiative;


            this.id = data.id;
            this.edit = true;
            // this.added_by = authUser;       
            this.text = 'Save';
            this.showForm();
            // this.scrollToTop();
            this.preview = false;

        },
        
        saveAgrolytic(){
             
             if (this.edit === true){ //update
                this.doSave();
             }else{ //create
                this.doCreate();
             }

        },

        removeAgrolytic(data){
            this.doRemove(data); 
        },

        statusBusy(stat){
         this.status = stat;
        }

    }
    
}
</script>