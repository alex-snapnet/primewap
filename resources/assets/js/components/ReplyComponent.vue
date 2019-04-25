<template>
  
  <span>

  <!-- <img v-show="busy" src="/images/loader.gif" style="height: 45px;"/> -->
  
   &nbsp;

   <div class="col-md-12" v-show="clicked">
      
      
      <div class="form-group">
        <input @keyup.enter="saveReply" v-model="data.content" type="text" class="form-control" placeholder="Reply Here." />
      </div>
      
      <div class="col-md-12" v-for="lst in list" :key="lst.id" style="padding-right: 0;">
         
          <div style="
    background-color: #eee;
    padding: 6px;
    margin-bottom: 3px;
">

<div>
  <b style="
    margin-bottom: 6px;
    display: inline-block;
">{{ lst.user.email? lst.user.email : 'anonymous-err' }}</b>
</div>

            {{ lst.content }}
            <!-- linkToForm -->


            <div align="right" style="
    color: #888;
    font-size: 11px;
">
                 <b>{{ lst.created_at | ago }}</b>
            </div>

<div class="col-xs-12">
    <a href="#" @click.prevent="linkToForm(lst)" class="btn btn-sm btn-outline-warning">
      <i class="fa fa-pencil"></i>
    </a>
    <a href="" @click.prevent="removeReply(lst)" class="btn btn-sm btn-outline-danger">
      <i class="fa fa-times"></i>  
    </a> 
</div>

          </div>

      </div>


<div class="col-lg-12">
<nav aria-label="Page navigation example">
  <ul class="pagination pagination-sm">
    <li v-bind:class="[{disabled: !pagination.prev}]" class="page-item">
        <a @click.prevent="fetchReplies(pagination.prev)" class="page-link" href="#">
          <i class="fa fa-angle-left"></i>
        </a>
    </li>
    <li class="page-item disabled"><a class="page-link">Page {{ pagination.current }} of  {{ pagination.total }}</a></li>
    <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>-->
    <li class="page-item" v-bind:class="[{disabled: !pagination.next}]"> 
        <a @click.prevent="fetchReplies(pagination.next)" class="page-link" href="#">
          <i class="fa fa-angle-right"></i>
        </a>
    </li>
  </ul>
</nav>
</div>


   </div>

  </span>

</template>

<script>
// import SectorMixin from './mixins';
export default {

        // $objReply->comment_id = $request->comment_id;
        // $objReply->user_id = $request->user_id;
        // $objReply->content = $request->content;


    data(){
       return {
          list:[],
          data:{
            content:''
          },
          edit:false,
          id:'',
          clicked:false,
          pagination:{}
       }
    },
    props:[
        'comp_id',
        'comment_id',
        'user_id'
    ],
    filters:{
       ago(value){
          return moment(new Date(value)).fromNow();
       }
    },
    mounted(){
       this.$root.$on('openReplies',(id)=>{
           
           if (id == this.comp_id){
              this.fetchReplies(); 
              this.clicked = true;             
           }

       });
    },
    methods:{
       
        makePagination(meta,links){

          console.log(meta,links);
           
           this.pagination.first = links.first;
           this.pagination.last = links.last;
           this.pagination.prev = links.prev;
           this.pagination.next = links.next;
           this.pagination.current = meta.current_page;
           this.pagination.total = meta.last_page;   

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

        fetchReplies(url){
          
          let api = '';
          
          if (url){
             api = url + '&comment_id=' + this.comment_id;
          }else{
             api = baseURL + 'reply?comment_id=' + this.comment_id;
          }

          fetch(api,{
            method:'GET'
          }).then(res=>res.json())
          .then(res=>{
              this.list = res.data;
              this.makePagination(res.meta,res.links);
              this.$root.$emit('replyCountChanged',{
                count:res.meta.total,
                comp_id:this.comp_id
              });
          });

// this.makePagination(res.meta,res.links);
        },
        saveReply(){
          toastr.success('Replying ...');
          if (this.edit){
            this.updateReply();
          }else{
            this.addReply();
          }
          this.edit = false;  
          this.data.content = '';
        },
        addReply(){
          fetch(baseURL + 'reply',{
            method:'POST',
            headers:{
              'content-Type':'application/json'
            },
            body:JSON.stringify({
              comment_id:this.comment_id,
              user_id:this.user_id,
              content:this.data.content
            })
          }).then(res=>res.json())
          .then(res=>{
             this.scanResponse(res);
             toastr.success('Reply Added');
             this.fetchReplies();
          });
        },
        updateReply(){
          fetch(baseURL + 'reply/' + this.id,{
            method:'PUT',
            headers:{
             'content-Type':'application/json'
            },
            body:JSON.stringify({
              content:this.data.content
            })
          }).then(res=>res.json())
          .then(res=>{
             this.scanResponse(res);
             toastr.success('Reply Updated.');
             this.fetchReplies();
          });
        },
        linkToForm(data){
          this.id = data.id;
          this.data.content = data.content;
          this.edit = true;
        },

        removeReply(data){

          if (confirm('Do you want to confirm this action?')){

            fetch(baseURL + 'reply/' + data.id,{
              method:'DELETE',
              headers:{
              'content-Type':'application/json'
              }
            }).then(res=>res.json())
            .then(res=>{
              this.scanResponse(res);
              toastr.success('Reply Removed');
              this.fetchReplies();
            });

          }else{
            toastr.success('Delete request cancelled.');
          }          

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
        }

    }

    
}
</script>

<style scoped>
 
 .select2{
 
     display: block;
 
 }


 li{
     cursor: pointer;
 }

 li:hover{
     background-color: azure;
 }
 .page-link{
   color: #000 !important;
 }

</style>