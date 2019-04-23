<template>
  
  <span>


  <span>

    <label for="">
        Operations Representative
    </label>
<div style="clear: both;"></div>
 
 <span style="display:inline-block;">
 
 <!-- <div @click="selected = true;$refs.searchText.focus();" style="display: inline-block;border: 1px solid #444;margin-bottom: 2px;width: 100%;padding: 5px;">
     {{ text_? text_ : 'Search Op - Reps.' }}
 </div><br />     -->
 
<div @click="selected=false;doFocus();" 
     v-show="selected" 
     style="overflow-x:hidden;text-overflow:ellipsis;width: 200px;border: 1px solid #444;padding:5px;">{{ text_? text_ : 'Select Op-Rep.' }}</div>

<span v-show="!selected" style="display: inline-block;">
    <input autofocus @blur="doBlur" 
           ref="searchText" 
           type="text" 
           v-model="searchText" 
           style="border: 1px solid #444;width: 200px;padding: 5px;"/>
    <ul v-show="users.length" style="
        position: absolute;
        z-index: 3000;
        background-color: #fff;
        border: 1px solid #ccc;
        list-style: none;
        padding: 11px;
        padding:5px;
    ">
        <li v-for="user in users" :key = "user.id" @click.prevent="selecUserId(user);text_=user.email;selected=true;">
            {{ user.email }}
        </li>
    </ul>
 </span>


 </span>

    <!-- <select ref="select2" class="form-control" v-model="op_rep_">
        <option value="">--Select Operations Representative--</option>
        <option v-for="user in users" v-bind:key="user.id" v-bind:value="user.id">
            {{ user.name }}
        </option>
    </select> -->

  </span>


  <img v-show="busy" src="/images/loader.gif" style="height: 45px;"/>
  &nbsp;

  </span>

</template>

<script>
// import SectorMixin from './mixins';
export default {
    
    props:[
        'op_rep',
        'text'
    ],
    data(){
       return {
           jQ:$,
           busy:false,
           users:[],
           usersCache:[],
           userIdMap:{},
           op_rep_:'',
           searchText:'',
           text_:'',
           selected:false
       }
    },
    watch:{
      op_rep_(n,o){
         this.$emit('opRepChange',n); 
        //  alert('emitted.');
      },
      op_rep(n,o){
          // alert(this.op_rep);
        this.op_rep_ = n;
      },
      text(n,o){
        // this.searchText = n;
        this.text_ = n;
        // alert(n);
        this.selected = true;
      },
      searchText(n,o){
        this.fetchOpReps();
      }
    },
    mounted(){

      // $(this.$refs.searchText).on('blur',(e)=>{
      //   //  alert('blurred ...');
      //   this.selected = true;
      //   console.log(this);
      // });

    //   alert(this.op_rep);
    //   this.fetchOpReps();

    //   $(this.$refs.select2).select2();

    },
    methods:{

       doBlur(){
    
          setTimeout(()=>{
            this.selected=true;
          },1000);
   

       },

        doFocus(){
          setTimeout(()=>{
            this.$refs.searchText.focus();
          },100);
        },
        selecUserId(data){
          this.op_rep_ = data.id; 
        //   this.searchText = data.email;
          this.usersCache = [];
          this.text_ = data.email;
          
          // alert(data.email);
          // alert(this.text_);

          this.selected = false;
        },
        fetchOpReps(){
          this.busy = true;  
          fetch(baseURL + 'user?role=prime_osp&searchText=' + this.searchText)
          .then(res=>res.json())
          .then(res=>{
              this.users = res.data;
              this.usersCache = this.users;
            //   $.each((k,v)=>{
            //       this.userIdMap[v.id] = v;
            //   });
              this.busy = false;
          });
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
