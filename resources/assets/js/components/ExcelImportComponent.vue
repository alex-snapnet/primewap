<template>
   <span>

<!-- comment modal start -->
<div class="modal fade" id="importGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Groups </h5>
        <button @click.prevent="doClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">

          <div class="container">
              <div class="row">

        <div class="col-md-12" style="text-align: left;">


<!-- content start -->

    <div style="display: inline-block;">
        <label for="">Select File</label>
        <input ref="fileInp" :id="getComponentId()" @change="doConversion()" type="file" />
        <div v-show="uploadedFile.length">&nbsp;&nbsp;{{ uploadedFile.length }} Bytes uploaded</div>
    </div>

    <div v-show="uploadedFile.length" style="overflow-x: scroll;">
         
         <table class="table">
             <tr>
                 <th v-for="( key , index ) in keys" :key="key">
                     {{ key }}
                     <a href="#" @click.prevent="removeKey(index)">X</a>
                 </th>
             </tr>
             <tr v-for="trs in transformedData" :key="trs.id">
                 <td v-for="key in keys" :key="key">
                     {{ trs[key] }}
                 </td>
             </tr>
         </table>
         
    </div>
    
    <div v-show="transformedData.length > 0">
        <button @click.prevent="doCreateBulk" class="btn btn-sm btn-primary">Create Bulk</button>
    </div>


<!-- content stop -->


           <div style="clear: both;"></div> 


        </div>

              </div>
          </div>
        

      </div>

      <div class="modal-footer">
            
      
      </div>

      

    </div>
  </div>
</div>

<!-- comment modal stop -->    

 <a  href="#" class="btn btn-outline-primary" data-target="#importGroupModal" data-toggle="modal">{{ label? label : 'Import Group' }}</a>

    </span>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            //var file = $('#fileInput').get(0).files.item(0);

        },

        watch:{
            fileValue(n,o){
               console.log(o);
            }
        },

        props:[
            'compId',
            'label',
            // 'apiTransform', //excel-to-json
            'apiBatchCreate',
            'fileValue'
        ],

        data(){
           return {
              apiTransform:baseURL + 'excel-to-json', 
              transformedData:[],
              uploadedFile:'',
              file:null,
              hidePop:false,
              keys:[]
           }
        },

        methods:{ 
             
            removeKey(index){
               this.keys.splice(index,1);
               console.log(this.keys);
            },
             
            doClose(){
                this.$refs.fileInp.value = '';
                this.uploadedFile = '';    
                this.transformedData = [];          
            }, 
     
            hideForm(){
                // $('#form').slideUp();
                $('.modal').trigger('click');
                this.toggle = true;
                //  this.resetForm();
            },

             getComponentId(){
                return this.compId + 'fileInput';
             },

             doConversion(){
                this.file = $('#' + this.compId + 'fileInput').get(0).files.item(0);                
                this.getBase64();
             },

             doCreateBulk(){
               fetch(this.apiBatchCreate,{
                   method:'POST',
                   body:JSON.stringify({
                       blob:this.transformedData
                   }),
                   headers:{
                       'content-Type':'application/json'
                   }
               })
               .then(res=>res.json())
               .then(res=>{
                   console.log(res);
                   this.hideForm();
                //    toastr.success('Batch creation successful.');
                   this.$emit('batchCreated');
                   this.doClose();
                //    this.$refs.fileInp.value = '';
                //    this.uploadedFile = '';
                   //this.fileValue = ''; //reset the file - input.
                //    $('#' + this.compId + 'fileInput').get(0).reset();

               });

             },

             sendToApiTransform(rawData){
                //this.uploadedFile
                fetch(this.apiTransform,{
                    method:'POST',
                    body:JSON.stringify({
                      blob:this.uploadedFile
                    }),
                    headers:{
                        'content-Type':'application/json'
                    }
                })
                .then(res=>res.json())
                .then(res=>{

                    console.log(res);
                    this.transformedData = res.binary;
                    if (this.transformedData[0]){
                      this.keys = Object.keys(this.transformedData[0]);
                    }
                    console.log(this.transformedData);

                });

             },

             getBase64() {
                var reader = new FileReader();
                var $self = this;

                reader.readAsDataURL(this.file);
                reader.onload = () =>{ 
                 this.uploadedFile = reader.result;
                 this.sendToApiTransform();
                }; 
                
                // function () {
                //     // console.log(reader.result);
                //     $self.uploadedFile = reader.result;

                // };
                
                reader.onerror = (error) => {
                    // console.log('Error: ', error);
                    this.uploadedFile = reader.result;

                };

             }

        }


    }
</script>
