@extends('layouts.panel')
@section('css')
<style type="text/css">
 /* table {
  table-layout: fixed;
  white-space: normal!important;
}

td {
  word-wrap: break-word;
}*/
div.trunc {
    white-space: nowrap; 
    width: 200px; 
    overflow: hidden;
    text-overflow: ellipsis; 
    
}
</style>
@endsection
@section('content')
 
 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                 <div class="col-md-12">
                 <h4 style="display: inline-block;"> Agrolytic Report for {{$agrolytic}} 

                    <button  onclick="reset('addAgrolyticReportForm')" style="cursor: pointer;" data-toggle="modal" data-target="#addAgrolyticReportModal" class="btn btn-sm btn-success">Add Report</button></h4>
                  
                 
                 </div>
                  <div  class="input-daterange input-group col-md-6" id="date-range">
                                            <input required  placeholder="from" value="{{isset($_GET['start']) ? $_GET['start'] : ''}}" type="date" class="form-control"   id="start">
                                            <button class="btn btn-primary input-group-addon bg-primary text-white b-0">to</button>
                                            <input required type="date" value="{{isset($_GET['end']) ? $_GET['end'] : ''}}"   placeholder="to" class="form-control" id="end">
                                            <button  id="formsmt" style="cursor: pointer;" class="btn btn-primary input-group-addon bg-primary text-white b-0">Go</button>
                           </div>
              </div>
                   
                  <p class="card-description">
                  </p>
                  <div class="table-responsive">

                      @if(count($reports)>0)
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                          Report
                          </th>
                          <th>
                            Status
                          </th>
                         
                          <th>
                          Added By
                          </th>
                          <th>
                           Date Added
                          </th>
                           <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      @foreach($reports as $report)
                      <tbody>
                        <tr>
                          <td>
                             {{$report->id}}
                          </td>
                          <td>
                           <div class="trunc"> {{$report->report}} </div>
                          </td>
                            <td>
                           {{$report->prog_status}}
                          </td>
                          
                          <td>
                            {{$report->user->name}}
                          </td>
                          <td>
                            {{date('Y-m-d',strtotime($report->day_week))}}
                          </td>
                         <td>
                            <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                               <a onclick="viewReport({{$report->id}})" data-toggle="modal" data-target="#addAgrolyticReportModal" class="dropdown-item">View</a>
                               <a style="cursor: pointer;" class="dropdown-item" onclick="setId({{$report->id}});" data-toggle="modal" data-target="#addComment">Add Comment</a>
                               <a class="dropdown-item" style="cursor: pointer;" onclick="dispComment({{$report->id}});" data-toggle="modal" data-target="#commentTrail">Comment Trail</a>
                                <a class="dropdown-item" onclick="deleteRecord({{$report->id}},'Report','agrolytic')" href="#">Delete</a> 
                           </div>
                           </div>
                           

                          </td>
                        </tr>
                      </tbody>
                      @endforeach
                     
                    </table>
                    <br>
                    {!! $reports->appends(Request::capture()->except('page'))->render() !!}
                     @else
                        <h4>No Record Found !!</h4>
                      @endif
                  </div>
                </div>
              </div>
            </div>
          @include('partials.modals.addAgrolyticReport')
          @include('partials.modals.addComment')
   @endsection
 @section('script')

<script type="text/javascript">
  $(function(){

     $('#submitAgrolyticReport').click(function(){

             $('.agro_id').val(sessionStorage.getItem('id'));
            submitForm('addAgrolyticReportForm','{{url('agrolytic')}}','progress');
     });

    $('#formsmt').click(function(){
        start=$('#start').val();
        end=$('#end').val();
        if(start=='' || end==''){
          return toastr.error('Please Select a date Range');
        }
      window.location="{{url('agrolytic')}}/agrolyticReport?id={{$id}}&start="+start+"&end="+end;
    })
  })


  function viewReport(id){

    formData={
      id:id,
      type:'viewSingleReport',
      _token:'{{csrf_token()}}'
    }

    $.post('{{url('agrolytic')}}',formData,function(data){  
            date=data.day_week.split(' ');   
                $('#report').val(data.report).attr('disabled',true);
                $('#status').val(data.status).attr('disabled',true);
                $('#prog_status').val(data.prog_status).attr('disabled',true);
                if(data.prog_status=='Pending')   $('#prog_status').val('0%').attr('disabled',true);
                $('#day_week').val(date[0]).attr('disabled',true);
                $('.addedBy').html('Added By '+data.user.name).show();
                $('#submitAgrolyticReport').hide();
        })
  }

</script>
 @endsection
