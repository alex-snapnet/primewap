<template>
   <div style="margin-top: 12px;padding:10px;">

  <!-- v-bind:value="value" -->
      <!-- v-on:input="$emit('input', $event.target.value)" -->

    <!-- <div>{{ getAggregator() }}</div> -->

        <span v-for="hst in groupHistory" v-bind:key="hst" style="display: inline-block;border: 1px solid #bbb;margin: 3px;padding: 5px;border-radius: 11px;background-color: #eee;">
            {{ hst }}
        </span>
    
    <span style="display: inline-block;position: relative;left: 32px;font-weight: bolder;font-size: 17px;border: 1px solid #555;padding: 6px;line-height: 11px;border-radius: 11px;background-color: #eee;">
        Select Group + </span>
    <select style="border-radius: 11px;padding: 5px;opacity: 0;position: relative;top: -7px;left: -114px;" v-bind:value="value" v-on:input="$emit('input', $event.target.value)" v-model="group" name="" id="" class="mb-2" @change="selectNewId">
         <option value="">..Select Group..</option>         
         <option v-for="group in groups" v-bind:key="group.id" v-bind:value="group.id">{{ group.name }}</option>
         <option value="0">..Back To Root..</option>
    </select>
    <div class="alert alert-info">Currently Selected: <u>{{ currentGroupName }}</u></div>
    <div>{{ status }}</div>
   </div> 
</template>
<script>
export default {

    props:[
     'value'
    ],
   
    data(){
       
       return {
          groupHistory:[], 
          group:'',
          groups:[],
          status:'',
          groupMaps:{},
          currentGroupName:'No Group Selected!'
        //   aggregator:''
       }


    },

    mounted(){
        this.fetchGroups(0);
    },

    watch:{
         
         value(new_,old){
            //  alert('changed.' + new_);
        //    this.groupMaps = []; 
           this.getGroup(new_);
         }

    },

    methods: {
       
        // getCurrentGroupName(){
        //   //groupMaps[group].name
        //   if (this.groupMaps[this.group]){
        //       return this.groupMaps[this.group].name;
        //   }else{
        //       return 'No group selected!';
        //   }
        // },

        selectNewId(){
            // console.log(group);
           this.fetchGroups(this.group);
           if (this.group == 0){
             this.groupHistory = []; //reset this tracker. 
           }else
             this.groupHistory.push(this.groupMaps[this.group].name); 
        },

        getAggregator(){
          return this.groupHistory.join(' -> ');
        },

        getGroup(id){
          fetch('api/groupname/' + id)
          .then(res=>res.json())
          .then(res=>{
            this.group = res.data.id;  
            this.currentGroupName = res.data.name;
            // this.groupMaps[res.data.id] = res.data;
            // this.selectNewId();

          })
          .catch(e=>console.log(e));
        },

        fetchGroups(group_name_id){
           this.statusBusy('Loading ...');  
            let api = 'api/groupname' + '?group_name_id=' + group_name_id;   //group_name_id=1


            // console.log(url,api);

            fetch(api)
            .then(res=>res.json())
            .then(res=>{

                this.groups = res.data;
                this.initGroupMaps(this.groups);
                this.statusBusy('');  
            })
            .catch(e=>console.log(e));

        },

        initGroupMaps(groups){
          groups.forEach(element => {
              this.groupMaps[element.id] = element
          });

          console.log(this.groupMaps);
        },


        statusBusy(msg){
         this.status = msg;
        }


    }

}
</script>
