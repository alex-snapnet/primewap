<template>

<span>

<div class="d-flex justify-content-between">
                      <p class="mb-2">{{ label }}</p>
                      <p class="mb-2 text-primary">{{ percentage }}%</p>
</div>

<div class="progress">

 <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :style="getPercentageStyle()" :aria-valuenow="getPercentageAria()" aria-valuemin="0" aria-valuemax="100"></div>

</div>

</span>
</template>

<script>
export default {

    data(){   
         return {
            name:''
         }
    },

    props:[
        'percentage',
        'label'
    ],

    mounted(){
      this.initProgress();
    },

    // props:[
    //     'progress'
    // ],
    watch:{

    },

    methods: {

        initProgress(){

        },

        getPercentageAria(){
          return this.percentage;
        },

        getPercentageStyle(){
          //width: 81.82%; background-color: #00b050;
          return {
             width:this.percentage + '%',
             backgroundColor:'#00b050'
          }; 
        }


    }
    
}
</script>