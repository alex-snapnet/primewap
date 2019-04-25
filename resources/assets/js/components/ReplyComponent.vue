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
          </div>

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

        fetchReplies(){

          fetch(baseURL + 'reply?comment_id=' + this.comment_id,{
            method:'GET'
          }).then(res=>res.json())
          .then(res=>{
              this.list = res.data;
              this.makePagination(res.meta,res.links);
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
             toastr.success('Reply Updated');
             this.fetchReplies();
          });
        },
        linkToForm(data){
          this.id = data.id;
          this.data.content = data.content;
          this.edit = true;
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

</style>