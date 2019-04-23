<template>
   <input :placeholder="placeholder" v-model="innerValue" type="text" :id="date_id" :style="date_style" data-date-format="yyyy/mm/dd"/>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
            this.initDateTime();
        },
        props:[
            'date_id',
            'date_value',
            'date_style',
            'placeholder'
        ],
        data(){
            return {
              innerValue:''
            };
        },
        watch:{
          date_value(n,o){
             this.innerValue = n;
          }
        },
        methods:{
            initDateTime(){
               let $this = this;
               $('#' + this.date_id).datepicker({
                   onSelect(dateText){
                       console.log(dateText);
                       $this.$emit('date-changed',dateText);
                   },
                   dateFormat:'yy/mm/dd'
               });
            }
        }

    }
</script>
