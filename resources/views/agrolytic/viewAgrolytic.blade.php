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
                 <div class="col-md-6" style="display: inline-block;">
                 <h4 > Agrolytic Report ({{$agrolytics->total()}})  {{isset($_GET['op_rep'])&& is_numeric($_GET['op_rep']) ? 'for '.Auth::user()->oprep($_GET['op_rep']) : '' }}
                  <button onclick="loadUrl('{{url('agrolytic/viewAgrolytic')}}')" class="pull-right btn btn-sm btn-success"><i class="mdi mdi-refresh"></i></button>
                 </h4>

      <form id="searh" method="GET" action="{{url('agrolytic/viewAgrolytic')}}" >
           <div  class="input-daterange input-group" id="date-range" >
                                            <input required  placeholder="from" value="{{isset($_GET['start']) ? $_GET['start'] : ''}}" type="date" class="form-control"  name="start"  id="start">
                                            <input type="hidden" value="{{isset($_GET['prospect']) ? $_GET['prospect'] : ''}}" name="prospect">
                                            <input type="hidden" value="{{isset($_GET['life_cycle']) ? $_GET['life_cycle'] : ''}}" name="life_cycle">
                                            <input type="hidden" value="{{isset($_GET['progress']) ? $_GET['progress'] : ''}}" name="progress">
                                            


                                            <button class="btn btn-primary input-group-addon bg-primary text-white b-0">to</button>
                                            <input required type="date" value="{{isset($_GET['end']) ? $_GET['end'] : ''}}"   placeholder="to" class="form-control" name="end" id="end">
                                            <button  id="formsmt"  onclick="$('#searh').submit()"  style="cursor: pointer;" class="btn btn-primary input-group-addon bg-primary text-white b-0">Go</button>
                           </div>
                 
                 </div>

                 <div class="col-md-3" style=" float: right;margin-top: 3%;">
                    <select onchange ="$('#searh').submit()" name="cat_id" class="form-control">
                            <option value="">-Select Category-</option>

                            @if(count($categories)>0)
                              @foreach($categories as $category)
                                <option {{isset($_GET['cat_id']) && $_GET['cat_id']==$category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                            @endif
                          </select>
                   </div> 
                 <div class="col-md-3" style=" float: right;margin-top: 3%;">
                      <select  onchange ="$('#searh').submit()"  id="osp2" name="op_rep" style="width: 100%;">
                       <option value=""> -Select Operation Reps- </option>
                      </select>
                   </div> 
              </div>
                   </div>
                 </form>
                  <p class="card-description">
                  </p>
                  <div class="table-responsive">
                         @if(count($agrolytics)>0)
                    <table class="table table-bordered sturdy" >
                      <thead>
                        <tr >
                          
                          <th>
                           Company Objectives 
                          </th>
                         <!--  <th>
                           Company Objective
                          </th> -->
                          <th>
                           Prospect/Client
                          </th>
                           <th>
                             Progress
                           </th>
                          <th>
                          Modified By
                          </th>

                          <th>
                            Created
                          </th>
                           <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                 
                      @foreach($agrolytics as $agrolytic)
                      <tbody>
                        <tr>
                         
                         <!--  <td >
                           <div data-toggle="tooltip"  data-original-title="{{$agrolytic->pag_objective}}" class="trunc"> {{$agrolytic->pag_objective}}  </div>
                          </td> -->
                          <td >
                            <div data-toggle="tooltip"  title="{{$agrolytic->comp_objective}}" class="trunc"> {!! $agrolytic->comp_objective !!} </div>
                          </td>
                          <td style="background-color: {{$agrolytic->status_color}}">
                           <div class="trunc" style="width:50px"> <a style="color: white;" href="{{url('agrolytic/allCustomer')}}?q={{$agrolytic->prospect}}" target="_blank">{{$agrolytic->prospect}} </div>
                          </td>
                          <td >
                           <div data-toggle="tooltip" title="{{$agrolytic->prog_status}}"  style="width:70px; cursor: pointer;" class="trunc" onclick="loadUrl('{{url('agrolytic/viewAgrolytic')}}?progress={{$agrolytic->prog_status}}')"> {{$agrolytic->prog_status}} </div>
                          </td>
                         <!--   <td>
                           <div class="trunc"> {!! $agrolytic->initiative !!} </div>
                          </td> -->
                            <td>
                          <div class="trunc" style="width: 150px;"> <a href="{{url('agrolytic/allUser')}}?q={{$agrolytic->lmodified->name}}" target="_blank"> {{$agrolytic->lmodified->name}} </a><div class="trunc">
                          </td>
                          
                         
                          <td>
                              {{date('Y-m-d',strtotime($agrolytic->created_at))}}
                          </td>
                          <td>
                          <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" style="cursor: pointer;" data-toggle="modal" data-target="#addAgrolytic" onclick="editModal({{$agrolytic->id}})">Edit / View Agrolytic</a>
                              <a class="dropdown-item"  style="cursor: pointer;" onclick="editModal({{$agrolytic->id}},1)" data-toggle="modal" data-target="#assignAgrolytic" >Assign to Operation Rep</a>
                              <a class="dropdown-item" onclick="editModal({{$agrolytic->id}},1)" style="cursor: pointer;" data-toggle="modal" data-target="#addAgrolyticReportModal">Add Report</a>
                              <a class="dropdown-item" href="{{url('agrolytic')}}/agrolyticReport?id={{$agrolytic->id}}" target="_blank">View Report</a>
                                <a class="dropdown-item" style="cursor: pointer;" onclick="setId({{$agrolytic->id}});" data-toggle="modal" data-target="#addComment">Add Comment</a>
                                <a class="dropdown-item" style="cursor: pointer;" onclick="dispComment({{$agrolytic->id}});" data-toggle="modal" data-target="#commentTrail">Comment Trail</a>
                                 <a class="dropdown-item" onclick="deleteRecord({{$agrolytic->id}},'Agrolytic','report')" href="#">Delete</a> 
                            </div>
                          </div>
                          </td>
                        </tr>
                      </tbody>
                      @endforeach
                     
                    </table>
                      <br>
                {!! $agrolytics->appends(Request::capture()->except('page'))->render() !!}
                     @else
                        <h4>No Record Found !!</h4>
                      @endif
                  </div>
                </div>
              </div>
            </div>

          @include('partials.modals.assignToOsp')
          @include('partials.modals.addAgrolyticReport')
          @include('partials.modals.addComment')
@endsection

@section('script')
<script type="text/javascript">

  function editModal(id,type=0){
      if(type==1){
        sessionStorage.setItem('id',id);
        return;
      }
      $.get('{{url('agrolytic')}}/getSingleAgrolytic',{id:id},function(data){
              
                
                  $('#id').val(data.id);
                  $('#pag_objective').val(data.pag_objective);
                  $('#comp_objective').val(data.comp_objective);
                  $('#prospect').val(data.prospect);
                  $('#status').val(data.status);
                  $('#initiative').val(data.initiative);
                  $('#cat_id').val(data.cat_id);
                  $('.addedBy').html('Added By '+data.user.name).show();
                  // return toastr.success(data.message);
             
      });
  }



      $(function(){

         select2Populate('osp','{{url('agrolytic')}}/searchAcrolytic');
         select2Populate('osp2','{{url('agrolytic')}}/searchAcrolytic');

 
      $('#date_from').datetimepicker();
        $('#date_from').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });

        $('#osp2').change(function(){
            osp=$('#osp2').val();
            window.location=window.location.href+'?op_rep='+osp+'&op_rep='+osp;

        });

        $("#date_to").on("dp.change", function (e) {
            $('#date_from').data("DateTimePicker").minDate(e.date);
        });

        $("#date_from").on("dp.change", function (e) {
            $('#date_to').data("DateTimePicker").maxDate(e.date);
        }); 



    $('#submitAgrolyticReport').click(function(){

             $('.agro_id').val(sessionStorage.getItem('id'));
            submitForm('addAgrolyticReportForm','{{url('agrolytic')}}','progress');
     });

    $('#submitFormAssign').click(function(){
      $('.agro_id').val(sessionStorage.getItem('id'));
      submitForm('assignTo','{{url('agrolytic')}}','progress');
    })
    }) 

  $(function(){
    $('#formsmt').click(function(){
        start=$('#start').val();
        end=$('#end').val();
        if(start=='' || end==''){
          return toastr.error('Please Select a date Range');
        }
      window.location="{{url('agrolytic')}}/viewAgrolytic?start="+start+"&end="+end;
    })
  })
  
</script>
 
@endsection
