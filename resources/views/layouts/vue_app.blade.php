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
  <!-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">  -->

  <!-- <link rel="stylesheet" href="{{asset('app_new.css')}}">  -->

  <link rel="stylesheet" href="{{asset('css/style.css')}}"> 

  <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">

  <!-- <link rel="stylesheet" href="{{asset('css/select2.min.css')}}"> -->

  <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">

 

  <!-- endinject -->

   <link href="{{asset('css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">

   <link href="{{asset('vendors/iconfonts/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
   
   <!-- /vendors/iconfonts/font-awesome/css/font-awesome.css" -->

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
      /* background: #aaced4 !important; */
      /* background:#0d4d56 !important; */
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

<style>
  .tool a{
    padding: 4px;background-color: #000;color: #fff;text-decoration: none;border-radius: 6px;padding: 3px;    
  }

  th{
    background-color: {{ Auth::user()->theme }};
    /* #1459ff */
    /* background-image: linear-gradient(#777, #fff); */
    color: #fff;
  }

  table{
    margin-bottom: 7px;
  }

  ul li a,ul li.dsabled a{
    /* background-color: #000 !important; */
    color: #eee !important;
  }

  .modal-backdrop{
     z-index:2;
  }


  .btn-icon{
    padding: 3px !important;
  }
</style>


  @yield('css')

</head>



<body class="">

  <div class="container-scroller" id="main-app">

    <!-- partial:../../partials/_navbar.html -->

    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row" 
       style="background: {{ Auth::user()->theme }} !important;">

      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center" style="border: 1px solid #888;width: 185px;">

        <a class="navbar-brand brand-logo">

          <img src="../../images/prime.png" alt="logo" />

        </a>

        <a class="navbar-brand brand-logo-mini">

          <img src="../../images/logo-mini.png" alt="logo" />

        </a>

      </div>

      <!-- navbar-menu-wrapper d-flex align-items-center -->
      <div class="navbar-menu-wrapper d-flex align-items-center" style="width:calc(100% - 185px)">
        <!-- navbar-nav navbar-nav-left header-links d-none d-md-flex -->
        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">

          <li class="nav-item">

            <a href="{{url('home')}}" class="nav-link">

              <i class="mdi mdi-elevation-rise"></i>Reports</a>

          </li>

          <li class="nav-item">
            <a href="{{ route('agrolytic.index') }}" class="nav-link">
              <i class="fa fa-check-circle"></i>Tasks</a>
          </li>          

    <sector></sector>       
    <group></group>
    <category></category>
    <user></user>
    <customer></customer>


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



<a href="#" style="color: #000 !important;text-align: left;display: inline-block !important;" class="dropdown-item" data-target="#themeSelectModal11" data-toggle="modal">
        Change Theme

</a>


<a href="#" style="color: #000 !important;text-align: left;display: inline-block !important;" class="dropdown-item" data-target="#changePasswordModal11" data-toggle="modal">
        Change Password

</a>




              <a style="color: #000 !important;text-align: left;display: inline-block !important;" href="{{url('logout')}}" onclick="logout()" class="dropdown-item">

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

      <!-- partial -->
      <!-- 219px -->
      <div class="main-panel" style="width: calc(100%)">

        <div class="content-wrapper" style="padding: 5px;">

        <change-password></change-password>

        <theme></theme>

          @yield('content')


        </div>

        <!-- content-wrapper ends -->

        <!-- partial:../../partials/_footer.html -->

        <footer class="footer">

          <div class="container-fluid clearfix">

            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © {{date('Y')}}

              <a href="http://www.snapnet.com.ng" target="_blank">Snapnet</a>. All rights reserved.</span>

            

            <!-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
              <i class="mdi mdi-heart text-danger"></i>
            </span> -->

          </div>

        </footer>

        <!-- partial -->

      </div>

      <!-- main-panel ends -->

    </div>

    <!-- page-body-wrapper ends -->

  </div>

  <!-- </div> -->

  <!-- container-scroller -->

  <!-- plugins:js -->


  <!-- <script src="{{ asset('js/mixins/sectors-mixin.js') }}"></script> -->




  

  <!-- endinject -->

  <!-- Plugin js for this page-->

  <!-- End plugin js for this page-->

  <!-- inject:js -->


  <script src="{{ asset('js/moment.js') }}"></script>

<script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>

<script src="{{asset('vendors/js/vendor.bundle.addons.js')}}"></script>


  <!-- <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>  -->

  <script src="{{asset('js/off-canvas.js')}}"></script>

  <script src="{{asset('js/misc.js')}}"></script> 

  <script src="{{asset('js/dashboard.js')}}"></script>

  <script src="{{ asset('js/jquery-ui.js') }}"></script>


  <!-- <script src="{{asset('js/bootstrap.min.js')}}"></script> -->


   <!-- <script type="text/javascript" src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script> -->

   <script type="text/javascript" src="{{asset('js/toastr.min.js')}}"></script>

   <!-- <script type="text/javascript" src="{{asset('js/select2.full.min.js')}}"></script> -->


<!-- consider -->

<!-- consider -->
    
     @yield('script')


   <script src="{{ asset('js/app.js') }}"></script>

  <!-- endinject -->

  <!-- Custom js for this page-->

  <!-- End custom js for this page-->

</body>



</html>

