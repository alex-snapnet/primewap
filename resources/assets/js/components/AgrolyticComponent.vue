<template>
  
  <div class="row">


<!-- modal start -->


<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->










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
    Manage Tasks
</span>

<!-- <div class="btn-group" role="group" aria-label="Basic example"> -->

      <!-- <export-csv v-bind:data="list"></export-csv>      -->
<!-- display: inline-block;position: relative;top: -5px; -->
<multiple-export v-bind:data="list" :style="{display:'inline-block',position:'relative',top:'-5px'}"></multiple-export>

 <excel-import :label="'Import Agrolytic'" style="position: relative;top: -4px;"  @batchCreated="batchCreated" :compId="23" :apiBatchCreate="batchCreate"></excel-import>

     <!-- <a data-toggle="modal" data-target="#agrolyticModal" id="form-btn" href="#" class="btn btn-sm btn-warning mb-2" >Import Excel Document</a> -->

<!-- agrolytic-batch-create -->

     <a  href="#" @click.prevent="resetFilters" class="btn btn-outline-primary mb-2" >Reset Filter</a>

     <a @click.prevent="doAddMode"  data-toggle="modal" data-target="#agrolyticModal" id="form-btn" href="#" class="btn btn-outline-primary mb-2" >Add Task</a>

     <!-- <a v-modal="'#agrolyticModal'" href="">Test Directive</a> -->
 
<!-- </div> -->

 </div>







       <h4 style="background-color: #1459ff14;padding: 7px;">

             <span style="display: inline-block;">
                <b style="font-size: 14px;color: #777;">Date From:.</b><br />  
                <!-- date_value -->
                <date-picker :placeholder="'Date From'" :date_value="dateFrom" @date-changed="getDateValueFrom" :date_id="1" :date_style="{border: '1px solid rgb(177, 177, 177)','font-size': '14px',padding: '7px'}" ></date-picker>
               <!-- <input v-bind="dateFrom" type="date" placeholder="Date From" style="border: 1px solid #ddd;font-size: 14px;padding: 7px;"/> -->
             </span>

             <span style="display: inline-block;">
                <b style="font-size: 14px;;color: #777;">Date To:.</b><br />  
                <date-picker :placeholder="'Date To'" :date_value="dateTo" @date-changed="getDateValueTo" :date_id="2" :date_style="{border: '1px solid rgb(177, 177, 177)','font-size': '14px',padding: '7px'}"></date-picker>
               <!-- <input v-bind="dateTo" type="date" placeholder="Date To" style="border: 1px solid #ddd;font-size: 14px;padding: 7px;"/> -->
             </span> 

             <span style="display: inline-block;">
                <b style="font-size: 14px;;color: #777;">Category:.</b><br />  
                <select v-model="cat_id" style="border: 1px solid rgb(177, 177, 177);font-size: 13px;padding: 7px;">
                    <option value="">--Select Category--</option>
                    <option v-for="cat in categories" v-bind:value="cat.id" v-bind:key="cat.id">{{ cat.name }}</option>
                </select>
             </span>

             <span style="display: inline-block;">
                <b style="font-size: 14px;;color: #777;">Sector:.</b><br />  
                <select v-model="sec_id" style="border: 1px solid rgb(177, 177, 177);font-size: 13px;padding: 7px;">
                    <option value="">--Select Sector--</option>
                    <option v-for="sec in sectors" v-bind:value="sec.id" v-bind:key="sec.id">{{ sec.name }}</option>
                </select>
             </span>


             <button @click.prevent="fetchAgrolytic()" class="btn btn-outline-primary">Filter</button>

       </h4>

        <div class="col-xs-12">

        </div>
    
        
        <table class="table" style="box-shadow: 0 0 3px rgba(0,0,0,0.2);">

            <tr>
                
                <!-- <th>
                    Objective
                </th> -->
                
                
                <th>
                    Customer/Client
                </th>
                <th>
                    Milestones
                </th>
                <th>
                  Comments
                </th>
                <th>
                  Op-Rep
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
                 <milestones 
                  :count="data_.reports?  data_.reports.length.toLocaleString() : 0"
                  :agro_id="data_.id"
                  :user_id="user_id"
                  :comp_id="data_.id"
                  >
                 </milestones>
               </td>
               <td>
                 <comment
                   :agro_id="data_.id"
                   :user_id="user_id"
                   :comp_id="data_.id"
                   :count="data_.reports? data_.comments.length.toLocaleString() : 0"></comment>
               </td>
               <td>
                   {{ data_.oprep? data_.oprep.name : 'N/A' }}
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

    <agrolytic-action :id="data_.id + 'id'" 
              :data="data_"
              @linktoForm="linktoForm"
              @doPreview="doPreview"
              @removeAgrolytic="removeAgrolytic"
              @selectAgrolyticRow="selectAgrolyticRow"
              @setCategoryFilter="setCategoryFilter"
              @setSectorFilter="setSectorFilter"
              :role="role"
              :user_id="user_id">
    </agrolytic-action>

               </td>
            </tr>

            </tbody>


        </table>





<!-- start of task card -->
<!-- stop of task card -->

<nav aria-label="Page navigation example">
  <ul class="pagination pagination-sm">
    <li v-bind:class="[{disabled: !pagination.prev}]" class="page-item">
        <a @click.prevent="fetchAgrolytic(pagination.prev)" class="page-link" href="#">
          <i class="fa fa-angle-left"></i>
        </a>
    </li>
    <li class="page-item"><a class="page-link">Page {{ pagination.current }} of  {{ pagination.total }}</a></li>
    <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>-->
    <li class="page-item" v-bind:class="[{disabled: !pagination.next}]"> 
        <a @click.prevent="fetchAgrolytic(pagination.next)" class="page-link" href="#">
          <i class="fa fa-angle-right"></i>
        </a>
    </li>
  </ul>
</nav>


        <div class="col-xs-12" style="height: 20px;" v-show="status" align="right">
             <img src="/images/loader.gif" style="height: 45px;"/>    
        </div>


           </div>
       </div>



     </div>


  <agrolytic-form
  @saveAgrolytic="saveAgrolytic"
  :text="text"
  :preview="preview"
  :data="data"
  :sectors="sectors"
  :categories="categories"
  :customers="customers"
  :groups="groups"
  :users="users">
  </agrolytic-form>
 
 <comment-input :commentData="commentData" @addComment="addComment"></comment-input>

 <comment-modal :id="id" :data="data"></comment-modal>

 <report-input :reportData="reportData" @addReport="addReport"></report-input>

 <assign-to-op-rep :agro_id="id" :op_rep="data.op_rep" :email="data.oprep? data.oprep.email : 'n/a' "></assign-to-op-rep>
 
</span>

<!-- {{ id }} -->
  
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
      'progress',
      'prog_status'
      // 'sec_id'
      // 'cat_id'
    ],

    data(){
         
         return {
            batchCreate:baseURL + 'agrolytic-batch-create?user_id=' + authUser,
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
      
      this.$root.$on('fetchAgrolytic',()=>{
        this.fetchAgrolytic();
      });
      

      this.fetchAgrolytic();
      this.fetchCategories();
      this.fetchSectors();
      
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

       batchCreated(){

          toastr.success('Batch Created Successfully ...');
          this.$root.$emit('fetchAgrolytic');

       },

       doAddMode(){
        this.preview = false;
        this.edit = false;
       },

       getDateValueFrom(vl){
         this.dateFrom = vl;
        //  alert(vl);
       },
       getDateValueTo(vl){
         this.dateTo = vl;
       },

       resetFilters(){ ///
          this.cat_id = '';
          this.sec_id = ''; 
          this.dateFrom = '';
          this.dateTo = '';
          console.log('called...');
          this.fetchAgrolytic();
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

           if (this.prog_status !== null){
             this.filters.push('prog_status=' + this.prog_status);
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
          fetch(baseURL + 'category?return_type=all')
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
          fetch(baseURL + 'customer?return_type=all')
          .then(res=>res.json())
          .then(res=>{
              this.customers = res.data;
          });
        },

        fetchGroups(){
          fetch(baseURL + 'groupname?return_type=all')
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
          fetch(baseURL + 'report' + '?user_id=' + authUser,{
              method:'POST',
              body:JSON.stringify(this.reportData),
              headers:{
                  'content-Type':'application/json'
              }
          }).then(res=>res.json())
          .then(res=>{
             
             this.scanResponse(res);
             //this.fetchAgrolytic();
             this.$root.$emit('fetchAgrolytic'); //wicked code.
             this.$root.$emit('fetchFinish');
             this.hideForm();


          }).catch(e=>console.log(e));

        },



        addComment(){
          fetch(baseURL + 'comment' + '?user_id=' + authUser,{
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
             this.$root.$emit('fetchFinish');
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
            // this.data.op_rep = ''; //data.op_rep;

            //initiative
            this.data.initiative = '';
            this.edit = false;

            this.reportData.report = '';
            this.commentData.comment = '';

         
        },

        doCreate(){

            this.statusBusy(true);  

                fetch(this.apis.createApi + '?user_id=' + authUser,{
                    
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
                    this.$root.$emit('fetchFinish');
                })
                .catch(e=>{
                      this.statusBusy(e);  
                      
                });

                this.text = 'Create';
        },

        doSave(){
               this.statusBusy(true);
               fetch(this.apis.updateApi + this.id + '?user_id=' + authUser,{
                    
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
                    this.$root.$emit('fetchFinish');

                })
                .catch(e=>console.log(e));

                this.text = 'Create';

        },

        doRemove(data){
          if (confirm('You you want to confirm this action?')){
           this.statusBusy(true);  
           fetch(this.apis.deleteApi + data.id + '?user_id=' + authUser,{
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
              this.$root.$emit('fetchFinish');
              this.hideForm();
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

          // alert('called...');

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

            this.data.oprep = data.oprep; //very important.
            // this.data.customer_id = data.customer_id;

            //initiative
            this.data.initiative = data.initiative;


            this.id = data.id;
            // console.log(this.id,'id-loaded');
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

<style scoped>
  .tool a{
    padding: 4px;background-color: #000;color: #fff;text-decoration: none;border-radius: 6px;padding: 3px;    
  }

  th{
    /* background-color: #1459ff; */
    /* background-image: linear-gradient(#777, #fff); */
    color: #fff;
  }

  table{
    margin-bottom: 7px;
  }

  ul li a,ul li.dsabled a{
    background-color: #000 !important;
    color: #eee !important;
  }

</style>
