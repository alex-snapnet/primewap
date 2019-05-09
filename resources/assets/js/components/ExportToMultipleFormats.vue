<template>

<span>

<div  class="dropdown" :style="style">
     <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-sm btn-outline-info btn-secondary dropdown-toggle">
        {{ text }}
     </button>
     
          <div aria-labelledby="dropdownMenuButton" class="dropdown-menu" style="position: absolute;">
               
               <a :href="csv.href" :download="csv.download" class="dropdown-item">
                    Excel (CSV - Format)
               </a>
               
               <a :href="doc.href" :download="doc.download" class="dropdown-item">
                    Word (DOC - Format)
               </a>
               
               <a :href="pdf.href" :download="pdf.download" class="dropdown-item">
                    Acrobat (PDF - Format)
               </a>
           
           </div>
</div>

     <!-- <a :style="excelStyle? excelStyle : {}" :href="href" :download="download" class="btn btn-outline-primary mb-2" >{{ text }}</a> -->

</span>



</template>

<script>
export default {
   
    props:[
       'data',
       'fields',
       'style'
    ],

    watch:{
       
       data(n,o){
          this.exportToExcel();
          this.exportToWord();
          this.exportToPdf();
          this.text = 'Export';
       }

    },

    data(){ 
         
         return {
             csv:{
               href:'',
               download:''
             }, 
             pdf:{
               href:'',
               download:''
             },
             doc:{
               href:'',
               download:''
             },
             text:'Loading...'
         }

    },


    mounted(){
      //this.fetchCustomers();
     //  this.exportToCsv();
    },

    methods: {
     
         convertJsonToCsv(args){

            var result, ctr, keys, columnDelimiter, lineDelimiter, data;

            data = args.data || null;
            if (data == null || !data.length) {
                return null;
            }

            columnDelimiter = args.columnDelimiter || ',';
            lineDelimiter = args.lineDelimiter || '\n';

            keys = Object.keys(data[0]);

            result = '';
            result += keys.join(columnDelimiter);
            result += lineDelimiter;

            data.forEach(function(item) {
                ctr = 0;
                keys.forEach(function(key) {
                    if (ctr > 0) result += columnDelimiter;

                    result += item[key];
                    ctr++;
                });
                result += lineDelimiter;
            });

            return result;

         },  

       convertJsonToWordFormat(){

       },  

       exportToExcel(){

            var data, filename, link;

            var csv = this.convertJsonToCsv({
                data: this.data
            });

            if (csv == null) return;

            filename = 'export.csv';

            var blob = new Blob([csv], {type: "text/csv;charset=utf-8;"});

            if (navigator.msSaveBlob){ // IE 10+
 
               navigator.msSaveBlob(blob, filename)
 
            }else{

                var url = URL.createObjectURL(blob);
                this.csv.href = url;
                this.csv.download = filename;
               //  this.text = 'Export To Excel';

            }
            
       },

       exportToWord(){

       },

       exportToPdf(){
           
       }
         

    }
    
}
</script>
