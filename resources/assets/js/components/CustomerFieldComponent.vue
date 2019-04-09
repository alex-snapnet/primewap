<template>
  <span>
      {{ name }}
  </span>
</template>

<script>
export default {

    data(){
         
         return {
            name:''
         }

    },

    mounted(){
    //   console.log(this.customerId);
      this.fetchFields(this.customerId);
    },

    props:[
        'customerId',
        'field'
    ],
    watch:{
      customerId(newVal,oldVal){
         this.fetchFields(newVal);
      }
    },

    methods: {

        fetchFields(id){
            this.name = 'loading...';
            fetch(baseURL + 'customer/' + id)
            .then(res=>res.json())
            .then(res=>{
                // this.customers = res.data;
                this.name = res.data[this.field];
            })
            .catch(e=>console.log(e));
        }

    }
    
}
</script>