@extends('layouts.panel')
 
@section('content')
 
 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">;
                 <div class="col-md-6">
                 <h4 style="display: inline-block;"> Agrolytic Category <button onclick="reset('addCategoryForm')" data-toggle="modal" data-target="#agrolyticCatModal" class="btn btn-sm btn-success">Add</button></h4>
                    
                 </div>
                 <div class="col-md-4">

                   </div> 
              </div>
                   
                  <p class="card-description">
                  </p>
                  <div class="table-responsive">

                      @if(count($categories)>0)
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
                            Action
                          </th>
                        </tr>
                      </thead>
                      @foreach($categories as $category)
                      <tbody>
                        <tr>
                          <td>
                             {{$category->id}}
                          </td>
                          <td>
                           <div class="trunc"> {{$category->name}} </div>
                          </td>
                         <td> 
                             <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" style="cursor: pointer;" onclick="viewCategory({{$category->id}})"  data-toggle="modal" data-target="#agrolyticCatModal" >Edit Category</a>
                               <a class="dropdown-item" onclick="deleteRecord({{$category->id}},'Category','agrolytic')" href="#">Delete</a> 
                              <a class="dropdown-item"  style="cursor: pointer;" href="{{url('agrolytic/viewAgrolytic')}}?cat_id={{$category->id}}" >View Agrolytic</a> 
                            </div>
                          </div>
                          </td>
                        </tr>
                      </tbody>
                      @endforeach
                     
                    </table>
                    
                     @else
                        <h4>No Record Found !!</h4>
                      @endif
                  </div>
                </div>
              </div>
            </div>
          @include('partials.modals.addAgrolyticCategory')
@endsection
 @section('script')

<script type="text/javascript">
 
  function viewCategory(id){
    formData={
      id:id,
      type:'singleCategory',
      _token:'{{csrf_token()}}'
    }

    $.post('{{url('agrolytic')}}',formData,function(data){  
             
                $('#name').val(data.name);
                $('#idCat').val(data.id);
            
                
        })
  }

  $(function(){
     $('#submitFormCategoryAssign').click(function(){
         
            submitForm('addCategoryForm','{{url('agrolytic')}}','progress');
        });
  })
</script>
 @endsection
