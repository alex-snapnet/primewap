<template>
  
  <span>

<!-- Modal -->
<div class="modal fade" id="agrolyticModal"  role="dialog"  >
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agrolytic {{ preview? 'Preview' : '' }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span >&times;</span>
        </button>
      </div>

      <form @submit.prevent="$emit('saveAgrolytic');busy=true;">
      <div class="modal-body">

          <div class="container">
              <div class="row">

        <div class="col-xs-12" style="width: 100%;">


           <div class="form-group">
               <!-- {{ data.group_name_id }} -->
             <!-- <group-select v-model="data.group_name_id"></group-select> -->
           </div>  

           <div class="form-group col-md-6">
               <label for="">
                   Select Group
               </label>

               <select class="form-control" v-model="data.group_name_id">
                   <option value="0">--Select Group--</option>
                   <option v-for="group in groups" v-bind:value="group.id" v-bind:key="group.id">
                       {{ group.name }}
                   </option>
               </select>
           </div>  



           <div class="form-group col-md-6">
               <label for="">
                   Customer / Client
               </label>
               <select class="form-control" v-model="data.customer_id">
                   <option value="">--Select Customer--</option>
                   <option v-for="customer in customers" v-bind:key="customer.id" v-bind:value="customer.id">
                       {{ customer.name }}
                   </option>
               </select>
           </div>  

<div style="clear: both;"></div>

           <div class="form-group col-md-12">
               <label for="">
                   Category
               </label>

               <select class="form-control" v-model="data.cat_id">
                   <option value="">--Select Category--</option>
                   <option v-for="category in categories" v-bind:key="category.id" v-bind:value="category.id">
                       {{ category.name }}
                   </option>
               </select>
           </div>  

           <div style="clear: both;"></div> 

           <div class="form-group col-md-12">
               <label for="">
                   Sector
               </label>

               <select class="form-control" v-model="data.sec_id">
                   <option value="">--Select Sector--</option>
                   <option v-for="sector in sectors" v-bind:key="sector.id" v-bind:value="sector.id">
                       {{ sector.name }}
                   </option>
               </select>
           </div>  


           <div class="form-group col-md-12">
               <label for="">
                   Prospect
               </label>

              <input type="text" class="form-control" placeholder="Prospect" v-model="data.prospect" />    
           </div>  

          <hr class="clearfix" style="display: block;clear: both;"/>    


           <div class="form-group col-md-6">
               <label for="">
                   Company Objective
               </label>

              <input type="text" class="form-control" placeholder="Company Objective" v-model="data.comp_objective" />    
           </div>  

           <div class="form-group col-md-6">
               <label for="">
                   Pag Objective
               </label>

              <input type="text" class="form-control" placeholder="Pag Objective" v-model="data.pag_objective" />    
           </div>  

<div style="clear: both;"></div>

           <div class="form-group col-md-12">
               <label for="">
                   Initiative    
               </label>

              <input type="text" class="form-control" placeholder="Initiative" v-model="data.initiative" />    
           </div>  



        
        
           <div class="form-group col-md-6">
               <op-rep-input :text="data.oprep? data.oprep.email : 'n/a' " @opRepChange="(value)=>{data.op_rep = value;}" :op_rep="data.op_rep"></op-rep-input>
           </div>  

           <div class="form-group col-md-6">
               <label for="">
                   Status
               </label>


               <select class="form-control" v-model="data.status">
                   <option value="">--Select Status--</option>
                   <option value="Perpetual">Perpetual</option>
                   <option value="Prospect">Prospect</option>

               </select>
           </div>  


        </div>

              </div>
          </div>
        

         <!-- <div class="col-md-12" style="border-top: 1px solid #aaa;padding-top: 11px;">
           <div align="right" class="col-md-12">
                <button class="btn btn-sm btn-success">{{ text }}</button>
           </div>
         </div> -->


      </div>

      <div class="modal-footer" v-show="!preview">

<img v-show="busy" src="/images/loader.gif" style="height: 45px;"/>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary">{{ text }}</button>
      </div>

      </form>


    </div>
  </div>
</div>

<!-- modal stop -->

  </span>

</template>

<script>
// import SectorMixin from './mixins';
export default {
    
    props:[
        'text',
        'preview',
        'data',
        'sectors',
        'categories',
        'customers',
        'groups',
        'users'
    ],
    data(){
       return {
           jQ:$,
           busy:false
       }
    },
    mounted(){
      this.$root.$on('fetchFinish',()=>{
        this.busy = false;    
      });
    },
    methods:{
        alert(v){
         alert(v);  
        }
    }    
}
</script>