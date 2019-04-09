<template>
  
  <div class="row">


<!-- comment modal start -->
<div class="modal fade" id="commentModalSelf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form @submit.prevent="saveComment">
      <div class="modal-body">

          <div class="container">
              <div class="row">

        <div class="col-md-12">


           <div class="form-group col-md-12">
               <label for="">
                   Comment
               </label>
               <input placeholder="Your comment" class="form-control" v-model="comment.comment" />
           </div>  

           <div style="clear: both;"></div> 


        </div>

              </div>
          </div>
        

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" data-target="#commentModal" data-toggle="modal">Post Comment</button>
      </div>

      </form>


    </div>
  </div>
</div>
<!-- comment modal stop -->



<div class="col-lg-12">
      <div class="card">
          <div class="card-body" style="padding-left: 7px;padding-right: 7px;">


<div class="col-lg-12">
    <h4><u>Comments</u></h4>
</div>
<div class="col-lg-12" align="right">
    <!-- <a href="/manage-agrolytic"  class="btn btn-info" style="margin-bottom: 7px;">Back To Agrolytic</a> -->


<input v-show="canModify" class="form-control" style="margin-bottom: 7px;" type="text" @keyup.enter="saveComment" v-model="comment.comment" placeholder="Type in your comment here." />


    <!-- <a v-show="canModify" href="#" data-target="#commentModalSelf" data-toggle="modal" class="btn btn-success" style="margin-bottom: 7px;"> + Add Comment</a> -->
</div>

<span style="height: 380px;overflow-y: scroll;display:inline-block;width: 100%;">
    <!-- start loop -->
    <div class="col-lg-12" v-for="com in comments" v-bind:key="com.id">
  

         <div class="alert alert-info" style="background-color: #fff;border: 1px solid #ddd;">
             <div><b><u>{{ com.user.name }}</u></b></div>
             <p>{{ com.comment }}</p>
             <div>
               <small> {{ com.created_at | ago }} </small>
             </div>
             <div align="right">
<!-- data-target="#commentModalSelf" data-toggle="modal" -->
                 <a v-show="canModify" href="#" @click.prevent="linktoForm(com)" class="btn btn-info btn-sm" style="background-color: #8a8aca;border: 0;">Edit</a>
                 <a v-show="canModify" href="" @click.prevent="removeComment(com)" class="btn btn-danger btn-sm" style="background-color: #e29292;border: 0;">Remove</a> 
             </div>
         </div>


    </div>
    <!-- end loop -->
  </span>  

    <div>
      <!-- {{ agro_id }} , {{ user_id }} -->
    </div>


          </div>
      </div>

</div>


<div class="col-lg-12">
<nav aria-label="Page navigation example">
  <ul class="pagination pagination-sm">
    <li v-bind:class="[{disabled: !pagination.prev}]" class="page-item">
        <a @click.prevent="fetchComments(pagination.prev)" class="page-link" href="#">Previous</a>
    </li>
    <li class="page-item disabled"><a class="page-link">Page {{ pagination.current }} of  {{ pagination.total }}</a></li>
    <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>-->
    <li class="page-item" v-bind:class="[{disabled: !pagination.next}]"> 
        <a @click.prevent="fetchComments(pagination.next)" class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
</div>


  </div>

</template>

<script>
export default {
    
    props:[
        'agro_id',
        'user_id'
    ],

    watch:{
       agro_id(newValue,oldValue){
        this.cacheUrl = ''; 
        this.fetchComments();
        this.fetchAgrolytic();          
       }
    },

    filters:{
       ago(value){
          return moment(new Date(value)).fromNow();
       }
    },

    data(){
         
         return {
             list:[],
             index:'',
             canModify:false,
             baseUrl:baseURL,
             cacheUrl:'',
             comments:[],
             comment:{
               id:'',  
               agro_id:'',
               user_id:'',
               comment:'Your comment ...'
             },
             edit:false,
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
      //this.commentModalSelf();
      this.fetchComments();
      this.fetchAgrolytic();
    },

    methods: {


        fetchAgrolytic(){
           fetch(this.baseUrl + 'agrolytic/' + this.agro_id,{
               method:'Get'
           })
           .then(res=>res.json())
           .then(res=>{
               this.agrolytic = res.data;
               if (this.user_id == this.agrolytic.user_id){
                 this.canModify = true;
               }else{
                 this.canModify = false;  
               }
           });
        },

        makePagination(meta,links){
           
           this.pagination.first = links.first;
           this.pagination.last = links.last;
           this.pagination.prev = links.prev;
           this.pagination.next = links.next;
           this.pagination.current = meta.current_page;
           this.pagination.total = meta.last_page;   

        },

        addComment(){
          

        },

        fetchComments(url){

            let api = '';
            if (url){
             api = url + '&agro_id=' + this.agro_id;
             this.cacheUrl = api;
            }else{
               if (this.cacheUrl){
                //do nothing..., simply retain the cacheUrl.  
               }else{
                api = this.baseUrl + 'comment?agro_id=' + this.agro_id;   
                this.cacheUrl = api;
               } 
            }

            fetch(this.cacheUrl)
            .then(res=>res.json())
            .then(res=>{

                this.comments = res.data;
                // this.statusBusy('');  
                this.makePagination(res.meta,res.links);

            })
            .catch(e=>console.log(e));

        },

        closeForm(){
            $('.modal').trigger('click');          
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

        linktoForm(comment){
            //    id:'',  
            //    agro_id:'',
            //    user_id:'',
            //    comments:''
            // console.log(comment);
            this.comment.agro_id = this.agro_id;
            this.comment.user_id = this.user_id;
            this.comment.id = comment.id,
            this.comment.comment = comment.comment;
            this.edit = true;
        },
        saveComment(){
             if (this.edit){
               this.doSave();   
               this.edit = false;
             }else{
               this.doCreate(); 
            //    this.edit = false;
             }
        },
       
        doSave(){
          this.comment.agro_id = this.agro_id;
          this.comment.user_id = this.user_id;

          fetch(this.baseUrl + 'comment/' + this.comment.id,{
              method:'PUT',
              body:JSON.stringify(this.comment),
              headers:{
                  'content-Type':'application/json'
              }
          }).then(res=>res.json())
          .then(res=>{
             this.scanResponse(res);
            //  this.hideForm();
             this.comment.comment = '';
            //  this.closeForm();
             this.fetchComments(); 
          }).catch(e=>console.log(e));
        },
        doCreate(){
          this.comment.agro_id = this.agro_id;
          this.comment.user_id = this.user_id;

          fetch(this.baseUrl + 'comment',{
              method:'POST',
              body:JSON.stringify(this.comment),
              headers:{
                  'content-Type':'application/json'
              }
          }).then(res=>res.json())
          .then(res=>{
             this.scanResponse(res);
            //  this.hideForm();
             this.comment.comment = '';
            //  this.closeForm();
             this.fetchComments();
          }).catch(e=>console.log(e));
        }, 
        doRemove(comment){
          this.linktoForm(comment);   
        //   this.comment.agro_id = this.agro_id;
        //   this.comment.user_id = this.user_id;

          fetch(this.baseUrl + 'comment/' + this.comment.id,{
              method:'DELETE',
              headers:{
                  'content-Type':'application/json'
              }
          }).then(res=>res.json())
          .then(res=>{
             this.scanResponse(res);
            //  this.hideForm();
            //  this.comment.comment = '';
            //  this.closeForm();
             this.fetchComments();
          }).catch(e=>console.log(e));
        },

        removeComment(comment){
          if (confirm('You you want to confirm this action?')){
             this.doRemove(comment);
          }
        },

        statusBusy(stat){
         this.status = stat;
        }

    }
    
}
</script>
