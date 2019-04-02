<template>
<div class="progress">
    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 71.43%; background-color: #00b050;" aria-valuenow="71.43" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</template>

<script>
export default {

    data(){   
         return {
            name:''
         }
    },

    mounted(){
      this.initProgress();
    },

    props:[
        'progress'
    ],
    watch:{

    },

    methods: {

        initProgress(){

        }

    }
    
}
</script>