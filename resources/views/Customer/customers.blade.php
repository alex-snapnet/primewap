@extends('layouts.panel')
@section('css')
<style type="text/css">
  div.trunc {
    white-space: nowrap; 
    width: 200px; 
    overflow: hidden;
    text-overflow: ellipsis; 
    
}
</style>
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}">

@endsection
@section('content')
 
 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                 <div class="col-md-6">
                 <h4 style="display: inline-block;"> All Customer(s)&nbsp;<button data-toggle="modal" data-target="#addCustomerModal" id="addCustomer" class="btn btn-sm btn-primary">Add Customer</button></h4>
                    <div  class="input-daterange input-group" id="date-range">
                                         
                                            <input required type="text" value="{{isset($_GET['q']) ? $_GET['q'] : ''}}"   placeholder="Enter email or name to search" class="form-control" id="q">
                                            <button  id="formsmt" style="cursor: pointer;" class="btn btn-primary input-group-addon bg-primary text-white b-0">Search</button>
                           </div>
                 
                 </div>
                 <div class="col-md-4">
                    
                   </div> 
              </div>
                   
                  <p class="card-description">
                  </p>
                  <div class="table-responsive">

                      @if(count($customers)>0)
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                           Name
                          </th>
                          <th>
                          Email
                          </th>
                          <th>
                            Address
                          </th>
                          <th>
                          Phone Number
                          </th>
                         
                          <th>
                           Action
                          </th>
                        </tr>
                      </thead>
                      @foreach($customers as $customer)
                      <tbody>
                        <tr> 
                          <td>
                             {{$customer->name}}
                          </td>
                          <td>
                           {{$customer->contact_email}}
                          </td>
                            <td>
                          <div class="trunc"> {{$customer->address}} </div>
                          </td>
                          <td>
                           <code> {{$customer->phone_num}} </code>
                          </td>
                         
                         <td>

                           <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                               <a style="cursor: pointer;" class="dropdown-item" data-toggle="modal" data-target="#addCustomerModal" id="editCustomer" onclick="editCustomer({{$customer->id}},'{{$customer->name}}','{{$customer->contact_email}}','{{$customer->address}}','{{$customer->phone_num}}','{{$customer->user->name}}')">Edit</a>

                               <a class="dropdown-item"  data-toggle="modal" data-target="#addCustomerInformationModal" href="#">Add Information</a> 
                              
                              <a class="dropdown-item" onclick="deleteRecord({{$customer->id}},'Customer','agrolytic')" href="#">Delete</a> 

                               <a class="dropdown-item"  href="{{url('agrolytic/viewAgrolytic')}}?prospect={{$customer->name}}">View Report</a>   
                          </div>
                          </div>
                         </td>
                        </tr>
                      </tbody>
                      @endforeach
                    
                    </table>
                    <br>
                    {!! $customers->appends(Request::capture()->except('page'))->render() !!}
                     @else
                        <h4>No Record Found !!</h4>
                      @endif
                  </div>
                </div>
              </div>
            </div>

@include('partials.modals.addCustomer')
@include('partials.modals.addCustomerInfoModal')
@endsection
 @section('script')

   <script type="text/javascript" src="{{asset('assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}"></script>
<script type="text/javascript">
  $(function(){

     $('.fancytextbox').wysihtml5();
     
    $('#formsmt').click(function(){
        q=$('#q').val();
        
      window.location="{{url('agrolytic')}}/allCustomer?q="+q;
    });

  $('#submitCustomerForm').click(function(){

            submitForm('addCustomerForm','{{url('agrolytic')}}','progress');
   });
  $('#addCustomer').click(function(){
        reset('addCustomerForm');
            $('#custID').val('');
  })

  });

  function editCustomer(id,name,contact_email,address,phone_num,addedBy){ 
    $('#custID').val(id);
    $('#name').val(name);
    $('#contact_email').val(contact_email);
    $('#address').val(address);
    $('#phone_num').val(phone_num);
    $('#addedBy').html('Added By '+addedBy);
  
  }
</script>
 @endsection
