<template>
  
  <span>


<!-- comment modal start -->
<div class="modal fade" :id="'commentListModal' + comp_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comment{{ commentCount > 1 ? 's':'' }} ({{ commentCount.toLocaleString() }}) 

        <img v-show="busy" src="/images/loader.gif" style="height: 30px;"/>
        
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

          <div class="container">
              <div class="row">

        <div class="col-md-12">


<!-- content start -->


<div class="col-lg-12" style="padding: 0;">
      <div class="card">
          <div class="card-body" style="padding-left: 7px;padding-right: 7px;">


<!-- <div class="col-lg-12">
    <h4>    
    </h4>
</div> -->

<div class="col-lg-12" align="right">
    <!-- <a href="/manage-agrolytic"  class="btn btn-info" style="margin-bottom: 7px;">Back To Agrolytic</a> -->


<input v-show="canModify" class="form-control" style="margin-bottom: 7px;" type="text" @keyup.enter="saveComment" v-model="comment.comment" placeholder="Type in your comment here." />


    <!-- <a v-show="canModify" href="#" data-target="#commentModalSelf" data-toggle="modal" class="btn btn-success" style="margin-bottom: 7px;"> + Add Comment</a> -->
</div>

<span style="height: 300px;overflow-y: scroll;display:inline-block;width: 100%;">
    <!-- start loop -->
    <div class="col-lg-12" v-for="com in comments" v-bind:key="com.id">
  

         <div class="alert alert-info" style="background-color: #fff;border: 1px solid #ddd;">
             <div>
               <b>
                <u style="
    display: inline-block;
    margin-bottom: 6px;
">{{ com.user.name }}</u>
               </b></div>
             <p>{{ com.comment }}</p>
             <!-- {{ inMinutes(com.created_at) }} -->
             <div>
               <small> {{ com.created_at | ago }} </small>
             </div>
             <div align="right">
<!-- data-target="#commentModalSelf" data-toggle="modal" -->
<!-- v-show="canModifySingle(com) && inMinutes(com.created_at)" -->
<!-- //openReplies -->

                 <a style="font-size: 12px;" href="#" @click.prevent="$root.$emit('openReplies',com.id)" class="btn btn-sm btn-outline-success">
                   Replies ({{ com.replies_count }})
                 </a>

                 <a href="#" @click.prevent="linktoForm(com)" class="btn btn-sm btn-outline-warning">
                   <i class="fa fa-pencil"></i>
                 </a>
                 <a href="" @click.prevent="removeComment(com)" class="btn btn-sm btn-outline-danger">
                   <i class="fa fa-times"></i>  
                 </a> 
             </div>


         <!-- reply component here -->
         <reply
          :comp_id="com.id"
          :comment_id="com.id"
          :user_id="user_id"
         ></reply> 


         </div>


         <!-- openReplies -->
          


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

<!-- content stop -->

           <div style="clear: both;"></div> 


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


<!-- content start -->

<!-- content stop -->


                 <a @click.prevent="init" href="" style="
color: rgb(255, 255, 255);background-color: rgb(0, 0, 0);padding: 4px;border-radius: 50%;display: inline-block;text-align: center;
"  class="count-indicator" :data-target="'#commentListModal' + comp_id" data-toggle="modal">
                  <span class="count">{{ count?  count.toLocaleString() : 0 }}</span>
                 </a>  


  </span>

</template>

<script>
export default {
    
    props:[
        'agro_id',
        'user_id',
        'comp_id',
        'count'
    ],

    watch:{
       agro_id(newValue,oldValue){
        //  alert('agro-change.');
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
             busy:false,
             agro_id_cache:'',
             list:[],
             index:'',
             canModify:false,
             baseUrl:baseURL,
             cacheUrl:'',
             comments:[],
             commentCount:0,
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

      this.$root.$on('reloadComment',(agro_id)=>{
        //  console.log(agro_id,this.agro_id);  
          // alert('agro-change--root.');
          this.agro_id_cache = agro_id;
          // this.fetchComments();
          // this.fetchAgrolytic();
        // if (this.agro_id == agro_id){}

      });
    },

    methods: {
          
        init(){
          this.fetchComments();
          this.fetchAgrolytic();
        }, 

        inMinutes(d1){
         let t2 = (new Date).getTime();
         let t1 = (new Date(d1)).getTime();
         return (parseInt((t2-t1)/(60*1000)) <= 1);
        },
        canModifySingle(data){
          return (data.user_id == authUser);
        },

        fetchAgrolytic(){
           fetch(this.baseUrl + 'agrolytic/' + ((this.agro_id)? this.agro_id : this.agro_id_cache),{
               method:'Get'
           })
           .then(res=>res.json())
           .then(res=>{
               this.agrolytic = res.data;
               if (this.user_id == this.agrolytic.user_id || this.user_id == this.agrolytic.op_rep){
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
           this.commentCount = meta.total;
           

        },

        addComment(){
          

        },

        fetchComments(url){
            this.busy = true; 
            let api = '';
            if (url){
             api = url + '&agro_id=' + ((this.agro_id)? this.agro_id : this.agro_id_cache);
             this.cacheUrl = api;
            }else{
                api = this.baseUrl + 'comment?agro_id=' + this.agro_id;   
              //  if (this.cacheUrl){
              //   //do nothing..., simply retain the cacheUrl.  
              //   console.log(this.cacheUrl);
              //  }else{
              //   this.cacheUrl = api;
              //  }
            }

            console.log(this.cacheUrl);

            fetch(api)
            .then(res=>res.json())
            .then(res=>{

                this.comments = res.data;
                // this.statusBusy('');  
                this.makePagination(res.meta,res.links);
                // this.$root.$emit('fetchAgrolytic'); //wicked code.
                this.busy = false;

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
          this.busy = true;
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

          fetch(this.baseUrl + 'comment/' + this.comment.id + '?user_id=' + authUser,{
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
             this.$root.$emit('fetchAgrolytic'); //wicked code.
          }).catch(e=>console.log(e));
        },
        doCreate(){
          this.comment.agro_id = this.agro_id;
          this.comment.user_id = this.user_id;

          fetch(this.baseUrl + 'comment' + '?user_id=' + authUser,{
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
             this.$root.$emit('fetchAgrolytic'); //wicked code.
          }).catch(e=>console.log(e));
        }, 
        doRemove(comment){
          this.busy = true;
          this.linktoForm(comment);   
        //   this.comment.agro_id = this.agro_id;
        //   this.comment.user_id = this.user_id;

          fetch(this.baseUrl + 'comment/' + this.comment.id + '?user_id=' + authUser,{
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
             this.$root.$emit('fetchAgrolytic'); //wicked code.
          }).catch(e=>console.log(e));
        },

        removeComment(comment){
          if (confirm('You you want to confirm this action?')){
             this.doRemove(comment);
             this.edit = false;
          }
        },

        statusBusy(stat){
         this.status = stat;
        }

    }
    
}
</script>

<style scoped>
 .page-link{
   color: #000 !important;
 }
</style>