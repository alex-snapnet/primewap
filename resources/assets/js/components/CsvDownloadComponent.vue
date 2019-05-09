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



         },

         exportToword(element, filename = ''){

            var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
            var postHtml = "</body></html>";
            var html = preHtml+document.getElementById(element).innerHTML+postHtml;

            var blob = new Blob(['\ufeff', html], {
                type: 'application/msword'
            });
            
            // Specify link url
            var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
            
            // Specify file name
            filename = filename?filename+'.doc':'document.doc';
            
            // Create download link element
            var downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);
            
            if(navigator.msSaveOrOpenBlob ){
                navigator.msSaveOrOpenBlob(blob, filename);
            }else{
                // Create a link to the file
                downloadLink.href = url;
                
                // Setting the file name
                downloadLink.download = filename;
                
                //triggering the function
                downloadLink.click();
            }
    
            document.body.removeChild(downloadLink);

         }

    }
    
}
</script>
