<template>

     <a :style="excelStyle? excelStyle : {}" :href="href" :download="download" class="btn btn-outline-primary mb-2" >{{ text }}</a>

</template>

<script>
export default {
   
    props:[
       'data',
       'fields',
       'api',
       'excelStyle'
    ],

    data(){ 
         
         return {
              href:'',
              download:'',
              text:'Loading...'
         }

    },

    watch:{
       data(n,o){
          this.exportToCsv();
       }  
    },

    mounted(){
      //this.fetchCustomers();
      this.exportToCsv();
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
         
         exportToCsv(){

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
                // link.setAttribute("href", url);
                this.href = url;

                // if (!csv.match(/^data:text\/csv/i)) {
                    // csv = 'data:text/csv;charset=utf-8,' + csv;
                // }

                // data = encodeURI(csv);
                // this.href = data;
                this.download = filename;
                this.text = 'Export To Excel';

            }
            
            //  var link = document.createElement("a");
    
            // if (link.download !== undefined){

            // feature detection, Browsers that support HTML5 download attribute
            // link = document.createElement('a');
            // link.setAttribute('href', data);
            // link.setAttribute('download', filename);
            // link.click();



         }

    }
    
}
</script>
