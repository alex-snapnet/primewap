<template>

<div class="row" style="margin-top: 12.5px;">
     
     <div @click="gotoAllAgrolyticLink" class="pointer col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
     <div class="card card-statistics">
         <div class="card-body">
             <div class="clearfix">
                 <div class="float-left">
                     <i class="mdi mdi-cube text-danger icon-lg"></i>
                 </div>
                 <div class="float-right">
                     <p class="mb-0 text-right">All Agrolytic Report</p>
                     <div class="fluid-container">
                         <h3 class="font-weight-medium text-right mb-0">{{ agroReportCount }}</h3>
                     </div>
                </div>
            </div> 
              <p class="text-muted mt-3 mb-0"></p>
        </div>
    </div>
   </div> 
   
   <div @click="gotoAllAgrolyticThisWeekLink"  class="pointer col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
     <div class="card card-statistics">
         <div class="card-body">
             <div class="clearfix">
                 <div class="float-left">
                      <i class="mdi mdi-receipt text-warning icon-lg"></i>
                 </div>
             <div class="float-right">
                  <p class="mb-0 text-right">Agrolytics This Week</p>
                  <div class="fluid-container">
                      <h3 class="font-weight-medium text-right mb-0">{{ agroReportThisWeekCount }}</h3>
                  </div>
             </div>
             </div> 
               <p class="text-muted mt-3 mb-0"></p>
        </div>
     </div>
   </div> 
   
   
   <div @click="gotoAllReportLink" class="pointer col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
      <div class="card card-statistics">
        <div class="card-body">
          <div class="clearfix">
            <div class="float-left">
              <i class="mdi mdi-poll-box text-success icon-lg"></i>
            </div>
            <div class="float-right">
              <p class="mb-0 text-right">All Report</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{ reportCount }}</h3>
            </div>
            </div>
          </div>
            <p class="text-muted mt-3 mb-0"></p>
        </div>
      </div>
      </div>
      
      <div @click="gotoAllReportThisWeekLink" class="pointer col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
         <div class="card card-statistics">
           <div class="card-body">
              <div class="clearfix">
                 <div class="float-left">
                   <i class="mdi mdi-account-location text-info icon-lg"></i>
                 </div>
                 <div class="float-right">
                   <p class="mb-0 text-right">Report this Week</p>
                   <div class="fluid-container">
                     <h3 class="font-weight-medium text-right mb-0">{{ reportThisWeekCount }}</h3>
                   </div>
                  </div>
              </div>
              <p class="text-muted mt-3 mb-0"></p>
            </div>
          </div>
        </div>
        
    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
            this.getAgrolyticCount();
            this.getAgrolyticThisWeekCount();
            this.getReportCount(); 
            this.getReportThisWeekCount();
            console.log(this.all_agrolytic_report_link);
        },

        props:[
            'all_agrolytic_report_link',
            'all_agrolytic_report_link_this_week',
            'all_report_link',
            'all_report_link_this_week',
            'user_id'
        ],

        data(){
            return {
                agroReportCount:'',
                agroReportThisWeekCount:'',
                reportCount:'',
                reportThisWeekCount:'',
                filters:[]
            };
        },

        methods:{
           
             

           gotoAllAgrolyticLink(){
              location.href = this.all_agrolytic_report_link;
           },

           gotoAllAgrolyticThisWeekLink(){
              location.href = this.all_agrolytic_report_link + '?date_days=8';
           },

           gotoAllReportLink(){
             location.href = this.all_report_link;
           },

           gotoAllReportThisWeekLink(){
             location.href = this.all_report_link + '?date_days=7';
           },

           handleFilters(){
              
           },


           getAgrolyticCount(){
               fetch(baseURL + 'agrolytic?return_type=count&user_id=' + this.user_id,{
                   method:'GET'
               })
               .then(res=>res.json())
               .then(res=>{
                   this.agroReportCount = res.count;
               });
           },

           getAgrolyticThisWeekCount(){
               fetch(baseURL + 'agrolytic?return_type=count&date_days=7&user_id=' + this.user_id,{
                   method:'GET'
               })
               .then(res=>res.json())
               .then(res=>{
                   this.agroReportThisWeekCount = res.count;
               });
           },


           getReportCount(){
               fetch(baseURL + 'report?return_type=count&user_id=' + this.user_id,{
                   method:'GET'
               })
               .then(res=>res.json())
               .then(res=>{
                   this.reportCount = res.count;
               });
           },

           getReportThisWeekCount(){
               fetch(baseURL + 'report?return_type=count&date_days=7&user_id=' + this.user_id,{
                   method:'GET'
               })
               .then(res=>res.json())
               .then(res=>{
                   this.reportThisWeekCount = res.count;
               });
           }



        }

    }
</script>
