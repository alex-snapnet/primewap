@extends('layouts.panel')

@section('content')
 
 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                 <div class="col-md-6">
                 <h4 style="display: inline-block;"> All User(s)&nbsp;<button data-toggle="modal" data-target="#addUserModal" id="addUser" class="btn btn-sm btn-primary">Add User</button></h4>
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

                      @if(count($users)>0)
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                          Name
                          </th>
                          <th>
                            Email
                          </th>
                          <th>
                          Role
                          </th>
                          <th>
                           Date Added
                          </th>
                          <th>
                           Action
                          </th>
                        </tr>
                      </thead>
                      @foreach($users as $user)
                      <tbody>
                        <tr>
                          <td>
                             {{$user->id}}
                          </td>
                          <td>
                           {{$user->name}}
                          </td>
                            <td>
                           {{$user->email}}
                          </td>
                          <td>
                           <code> {{$user->type}} </code>
                          </td>
                          <td>
                            {{date('Y-m-d',strtotime($user->created_at))}}
                          </td>
                         <td>
                           
                            <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                               <a style="cursor: pointer;" class="dropdown-item" data-toggle="modal" data-target="#addUserModal" id="editUser" onclick="editUser({{$user->id}},'{{$user->email}}','{{$user->name}}','{{$user->type}}')">Edit</a>

                               <a class="dropdown-item"  href="{{url('agrolytic/viewAgrolytic')}}?op_rep={{$user->id}}">View Report</a>   
                          </div>
                          </div>

                         </td>
                        </tr>
                      </tbody>
                      @endforeach
                    
                    </table>
                    <br>
                    {!! $users->appends(Request::capture()->except('page'))->render() !!}
                     @else
                        <h4>No Record Found !!</h4>
                      @endif
                  </div>
                </div>
              </div>
            </div>

@include('partials.modals.addUser')
@endsection
 @section('script')
<script type="text/javascript">
  $(function(){
    $('#formsmt').click(function(){
        q=$('#q').val();
        
      window.location="{{url('agrolytic')}}/allUser?q="+q;
    });

  $('#submitUserForm').click(function(){

            submitForm('addUserForm','{{url('agrolytic')}}','progress');
   });
  $('#addUser').click(function(){
        reset('addUserForm');
            $('#userID').val('');
  })

  });

  function editUser(id,email,name,role){ 
    $('#name').val(name);
    $('#email').val(email);
    $('#type').val(role);
    $('#userID').val(id);
    
  }
</script>
 @endsection
