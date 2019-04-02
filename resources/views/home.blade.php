@extends('layouts.vue_app')
@section('css')
<style type="text/css">
    .pointer{
        cursor: pointer;
    }
</style>

  <link rel="stylesheet" href="{{asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.addons.css')}}">
@endsection

@section('content')
 

<div class="col-lg-12">
  <div class="row">
            <div onclick="loadUrl('{{url('agrolytic/viewAgrolytic')}}')" class="pointer col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">All Agrolytic Report</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{$agrolytics}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                   
                  </p>
                </div>
              </div>
            </div>
            <div onclick="loadUrl('{{url('agrolytic/viewAgrolytic')}}?start={{date('Y-m-d',strtotime('-6 days'))}}&end={{date('Y-m-d',strtotime('+1 days'))}}')" class="pointer col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-receipt text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Agrolytics This Week</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{$agro['thisweek']}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                  
                  </p>
                </div>
              </div>
            </div>
            <div onclick="loadUrl('{{url('agrolytic/agrolyticReport')}}')" class="pointer col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-poll-box text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">All Report</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{$agro['allreport']}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    
                  </p>
                </div>
              </div>
            </div>
            <div onclick="loadUrl('{{url('agrolytic/agrolyticReport')}}?start={{date('Y-m-d',strtotime('-6 days'))}}&end={{date('Y-m-d',strtotime('+1 days'))}}')" class="pointer col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account-location text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Report this Week</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{$agro['thisweekreport']}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
              
                  </p>
                </div>
              </div>
            </div>
          </div>
</div>
<div class="col-lg-12">
<div class="row">
     <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Agrolytic Progress Chart</h4>
                  <canvas id="barChart" style="height:230px"></canvas>
                </div>
              </div>
            </div>
<div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title text-primary mb-5">Progress Report All Time</h2>
                   
                  @foreach($status as $key=>$status)
                  <div class="wrapper" style="cursor: pointer;" onclick="loadUrl('{{url('/agrolytic/viewAgrolytic')}}?life_cycle={{$key}}')">
                    <div class="d-flex justify-content-between">
                      <p class="mb-2">{{$key}}</p>
                      <p class="mb-2 text-primary">{{$status}}%</p>
                    </div>
                    <div class="progress">
                      <div  class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{$status}}%; background-color: {{Auth::user()->color($key)}}" aria-valuenow="{{$status}}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div><br>
                  @endforeach
                </div>
              </div>
            </div>
<!-- <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title text-primary mb-5">Last 7 Days</h2>
                   
                  @foreach($statusWeek as $key=>$statusWeek)
                  <div class="wrapper">
                    <div class="d-flex justify-content-between">
                      <p class="mb-2">{{$key}}</p>
                      <p class="mb-2 text-primary">{{$statusWeek}}%</p>
                    </div>
                    <div class="progress">
                      <div  class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{$statusWeek}}%; background-color: {{Auth::user()->color($key)}}" aria-valuenow="{{$statusWeek}}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div><br>
                  @endforeach
                </div>
              </div>
            </div> -->
          </div>
        </div>
@endsection
@section('script')


  <script src="{{asset('js/off-canvas.js')}}"></script>
  <script src="{{asset('js/misc.js')}}"></script>
  <!-- <script src="{{asset('js/chart.js')}}"></script> -->
 

  <script>
    $(function(){

   $.get('{{url('agrolytic')}}/getStatusReport',function(data){

var ctx = document.getElementById("barChart");
 
   
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["0%", "10%", "20%", "30%", "40%", "50%","60%","70%","80%","90%","100%"],
        datasets: [{
            label: 'Statistics of Report by %Progress',
            data: data,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        onClick: graphClickEvent,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
}); 
});

function graphClickEvent(event, array){

    window.location=('{{url('/agrolytic/viewAgrolytic')}}?progress='+array[0]._model['label']);
}

 });
</script>

@endsection