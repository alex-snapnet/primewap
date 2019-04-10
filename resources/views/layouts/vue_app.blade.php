@section('css')
<style type="text/css">
    .pointer{
        cursor: pointer;
    }


    ::-webkit-scrollbar {
    width: 12px;
}
 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    border-radius: 10px;
}
 
::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}

</style>

  <link rel="stylesheet" href="{{asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.addons.css')}}">
@endsection
<!DOCTYPE html>

<html lang="en">



<head>

  <!-- Required meta tags -->

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <script type="text/javascript">
     window.Laravel = {
        csrfToken:'{{ csrf_token() }}'
     };
     window.authUser = '{{ Auth::user()->id }}';
     window.authRole = '{{ Auth::user()->type }}';
     var baseURL = '{{ url("/") }}/api/';
  </script>
  <title>Prime Atlantic Agrolytic Action Plan</title>

  <!-- plugins:css -->

  <link rel="stylesheet" href="{{asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">

  <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">

  <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.addons.css')}}">

  <!-- endinject -->

  <!-- plugin css for this page -->

  <!-- End plugin css for this page -->

  <!-- inject:css -->

  <!-- bootstrap.min.css -->
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> 

  <!-- <link rel="stylesheet" href="{{asset('app_new.css')}}">  -->

  <link rel="stylesheet" href="{{asset('css/style.css')}}"> 

  <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">

  <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">

  <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">

 

  <!-- endinject -->

   <link href="{{asset('css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">

  <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" />

  <style type="text/css">

    .modal-content {

        background-color: #fff !important;

    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {

    color: #444;

     line-height: 10px !important; 

     /*height: 50px;*/
 
    }

    .content-wrapper {
      background: #dbe8ea !important;
    }

    .btn-success, .btn-info {
    /* color: #fff; */
      /* background-color: #3ba3e0 !important; */
      /* border-color: #3ba3e0 !important; */
    }    

    body{
        color:#000 !important;
        /* font-weight: 500 !important; */
    }

    .dropdown-item{
        /* color: #000 !important; */
        /* font-weight: 600; */
        font-size:15px;
    }


    .form-control{
        border: 1px solid #aaa;
    }

    .dropdown-menu{
     background-color: #fff;
     border: 1px solid #555;        
    }



</style>
<style style="text/css">
    .col-md-5, .col-md-6{
        display: inline-block;
        float: left;
    }


    /* table tr:nth-child(odd) {
       background-color: #eee;
    } */

    .modal-body{
      padding-top: 15px;
    }

   
    .modal{
        background-color: rgba(252,252,252,0.2);
    }

    .dropdown-divider{
        margin: 1px;
    }

    table td{
      padding-top: 7px !important;
      padding-bottom: 7px !important;
    }


</style>

  @yield('css')

</head>



<body class="">

  <div class="container-scroller">

    <!-- partial:../../partials/_navbar.html -->

    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center" style="width: 219px;">

        <a class="navbar-brand brand-logo">

          <img src="../../images/logo.png" alt="logo" />

        </a>

        <a class="navbar-brand brand-logo-mini">

          <img src="../../images/logo-mini.png" alt="logo" />

        </a>

      </div>

      <div class="navbar-menu-wrapper d-flex align-items-center">

        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">

          <span class="mdi mdi-menu"></span>

        </button>



        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">

          <li class="nav-item active">

            <a href="{{url('home')}}" class="nav-link">

              <i class="mdi mdi-elevation-rise"></i>Reports</a>

          </li>

         

        </ul>

        <ul class="navbar-nav navbar-nav-right">

         <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">

          <span class="mdi mdi-menu"></span>

        </button>



           

          <li class="nav-item dropdown d-none d-xl-inline-block">

            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">

              <span class="profile-text">{{Auth::user()->name}}</span>

              <img class="img-xs rounded-circle" src="../../images/faces/face1.jpg" alt="Profile image">

            </a>

            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">

              <a class="dropdown-item p-0">

                <div class="d-flex border-bottom">

                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">

                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>

                  </div>

                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">

                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>

                  </div>

                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">

                    <i class="mdi mdi-alarm-check mr-0 text-gray"></i>

                  </div>

                </div>

              </a>

              

              <a href="{{url('logout')}}" onclick="logout()" class="dropdown-item">

                Sign Out

              </a>

            </div>

          </li>

        </ul>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">

          <span class="icon-menu"></span>

        </button>

      </div>

    </nav>

    <!-- partial -->

    <div class="container-fluid page-body-wrapper">

      <!-- partial:../../partials/_sidebar.html -->

      

      <nav class="sidebar sidebar-offcanvas" id="sidebar" style="width: 219px;">

        <ul class="nav">

          <li class="nav-item nav-profile">

            <div class="nav-link">

              <div class="user-wrapper">

                <div class="profile-image">

                  <img src="../../images/faces/face1.jpg" alt="profile image">

                </div>

                <div class="text-wrapper">

                  <p class="profile-name">{{Auth::user()->name}}</p>

                  <div>

                    <small class="designation text-muted">{{ucfirst(str_replace('_',' ',Auth::user()->type))}}</small>

                    <span class="status-indicator online"></span>

                  </div>

                </div>

              </div>

              @if (Auth::user()->type == 'prime_admin')

              <a href="{{ route('agrolytic.index') }}" class="btn btn-success btn-block">New Agrolytic

              @endif 

                <i class="mdi mdi-plus"></i>

              </a>

            </div>

          </li>

          <li class="nav-item">

            <a class="nav-link" href="{{ route('agrolytic.index') }}">

              <i class="menu-icon mdi mdi-television"></i>

              <span class="menu-title">View Agrolytic</span>

            </a>

          </li>

      

          @if (Auth::user()->type == 'prime_admin')

          <li class="nav-item">

            <a class="nav-link" href="{{ route('group.index') }}">

              <i class="menu-icon mdi mdi-television"></i>

              <span class="menu-title">Agrolytic Groups</span>

            </a>

          </li>

          

           <li class="nav-item">

            <a class="nav-link" href="{{ route('category.index') }}">

              <i class="menu-icon mdi mdi-television"></i>

              <span class="menu-title">Categories</span>

            </a>

          </li>


          <li class="nav-item">

            <a class="nav-link" href="{{ route('sector.index') }}">

            <i class="menu-icon mdi mdi-television"></i>

            <span class="menu-title">Sectors</span>

            </a>

          </li>



           <li class="nav-item">

            <a class="nav-link" href="{{ route('user.index') }}">

              <i class="menu-icon mdi mdi-television"></i>

              <span class="menu-title">Manage User(s)</span>

            </a>

          </li>

         <li class="nav-item">

            <a class="nav-link" href="{{ route('customer.index') }}">

              <i class="menu-icon mdi mdi-television"></i>

              <span class="menu-title">Customers</span>

            </a>

          </li>

          @endif

        </ul>

      </nav>

      

      <!-- partial -->

      <div class="main-panel" style="width: calc(100% - 219px)">

        <div class="content-wrapper" style="padding: 5px;">

          @yield('content')


        </div>

        <!-- content-wrapper ends -->

        <!-- partial:../../partials/_footer.html -->

        <footer class="footer">

          <div class="container-fluid clearfix">

            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © {{date('Y')}}

              <a href="http://www.snapnet.com.ng" target="_blank">Snapnet</a>. All rights reserved.</span>

            

            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with

              <i class="mdi mdi-heart text-danger"></i>

            </span>

          </div>

        </footer>

        <!-- partial -->

      </div>

      <!-- main-panel ends -->

    </div>

    <!-- page-body-wrapper ends -->

  </div>

  <!-- container-scroller -->

  <!-- plugins:js -->


  <!-- <script src="{{ asset('js/mixins/sectors-mixin.js') }}"></script> -->


  <script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>

  <script src="{{asset('vendors/js/vendor.bundle.addons.js')}}"></script>


  

  <!-- endinject -->

  <!-- Plugin js for this page-->

  <!-- End plugin js for this page-->

  <!-- inject:js -->

  <script src="{{asset('js/off-canvas.js')}}"></script>

  <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script> 



  <script src="{{asset('js/bootstrap.min.js')}}"></script>

  <script src="{{asset('js/misc.js')}}"></script> 

   <script type="text/javascript" src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>

   <script type="text/javascript" src="{{asset('js/toastr.min.js')}}"></script>

   <script type="text/javascript" src="{{asset('js/select2.full.min.js')}}"></script>


     @yield('script')


   <script src="{{ asset('js/jquery-ui.js') }}"></script>

   <script src="{{ asset('js/app.js') }}"></script>


  <script type="text/javascript">



  var   $type= window.location.href=='{{url('agrolytic/viewAgrolytic')}}' ? 1 : 0 ;

    $(function(){



      $('#submitForm').click(function(){

           

              submitForm('addAgrolyticForm','{{url('agrolytic')}}','progress');

       });



      $('[data-toggle="tooltip"]').tooltip();

    

      $('.navbar-toggler').click(function(){

            $('body').toggleClass('sidebar-icon-only');

      })



      //  select2Populate('ospA','{{url('agrolytic')}}/searchAcrolytic');

      //  $('#type2').val($type);

      $('#submitManagerComment').click(function(){



            submitForm('addManagerComment',"{{url('agrolytic')}}",'progress');



       })

        });



 

  function dispComment(id){

    $('#dispCommentTrail').html('Loading...');

    $('#dispCommentTrail').load('{{url('agrolytic')}}/comments?id='+id+'&type='+$type);

  }



  function setId(id){

    sessionStorage.setItem('id',id);

    $('.agro_id').val(id);

  }

  

  function loadUrl(url){

      window.location=url;

   }

   

    function reset(id){

      $('.form-control').attr('disabled',false);

      $('.addedBy').hide();

      $('#'+id)[0].reset();

    }



function deleteRecord(id,model,relation){



    formdata = {

        id:id,

        model:model,

        relation:relation,

        _token:'{{csrf_token()}}',

        type:'delete'

    }

    if(confirm('Are Sure You want to delete record!!')){

      

       $.post('{{url('agrolytic')}}',formdata,function(data){

        if(data.status=='success'){

          window.location.reload();

        return   toastr.success(data.message);

        }

        return  toastr.error(data.message);



       });

    }

    else{

       toastr.error('Operation Cancelled');

    }



}

    function select2Populate(id,url){

               $('#'+id).select2({

                 ajax: {

                   delay: 250,

                   processResults: function (data) {



                    return {



                        results: data

                    };

                },

                data: function(params){

                    return {

                    q:params.term,

                    page_limit:10

                };

                },



                url: function (params) {

                    return url;

                }



            }

        });

    }



   function submitForm(formid,url,progress){



           formdata= new FormData($('#'+formid)[0]);

           formdata.append('_token','{{csrf_token()}}'); 

           

           $.ajax({

            url: url,

               type: 'POST',

               data: formdata,

               cache: false,

               contentType: false,

               processData: false,

               success:function(data,status,xhr){

                    if(data.status=='success'){

                        toastr.success(data.message);

                        setTimeout(function(){

                            window.location.reload();



                        },2000);

                        return;

                    } 

                    return toastr.error(data.message);

               },

                 xhr: function() {

                    var myXhr = $.ajaxSettings.xhr();

                    if (myXhr.upload) {

                // For handling the progress of the upload

                myXhr.upload.addEventListener('progress', function(e) {

                    if (e.lengthComputable) {

                        percent=Math.round((e.loaded/e.total)*100,2);

                        $('#'+progress).css('width',percent+'%');

                        $('#'+progress+'_text').text(percent+'%');

                    }

                } , false);

            }

            return myXhr;

        }

    });

 

        }





  </script>



  <!-- endinject -->

  <!-- Custom js for this page-->

  <!-- End custom js for this page-->

</body>



</html>

