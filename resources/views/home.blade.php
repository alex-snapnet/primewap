@extends('layouts.vue_app')

@section('content')

<style>
 .content-wrapper .col-lg-12{
  margin-top: 13px !important;
 } 
</style> 

<div class="col-lg-12" id="app">

<dash-board-metrics 
:all_agrolytic_report_link="'{{ route('agrolytic.index') }}'" 
:all_report_link="'{{ route('report.global') }}'"
:user_id="'{{ Auth::user()->id }}'">
  <img src="{{ url('/') }}/images/loader.gif" style="height: 45px;"/>
</dash-board-metrics>


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
//end

});

function graphClickEvent(event, array){

    window.location=('{{url('/agrolytic/viewAgrolytic')}}?progress='+array[0]._model['label']);
}

 });
</script>

@endsection