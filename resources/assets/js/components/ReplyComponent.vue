<template>
  
  <span>

  <img v-show="busy" src="/images/loader.gif" style="height: 45px;"/>
  
   &nbsp;

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
          id:''
       }
    },
    props:[
        'comp_id',
        'comment_id'
    ],
    mounted(){
       this.$root.$on('openReplies',(id)=>{
           
           if (id == this.comp_id){
              this.fetchReplies();              
           }

       });
    },
    methods:{
       
        makePagination(meta,links){
           
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
              this.makePagination(res.meta,res.links);
          });

// this.makePagination(res.meta,res.links);
        },
        saveReply(){
          if (this.edit){
            this.updateReply();
          }else{
            this.addReply();
          }
          this.edit = false;  
        },
        addReply(){
          fetch(baseURL + 'reply?comment_id=' + this.comment_id,{
            method:'GET'
          }).then(res=>res.json())
          .then(res=>{

          });
        },
        updateReply(){

        },
        linkToForm(data){
          
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