<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Scoops Troop') }} : Admin</title>
    <link href="assets/img/favicon-32x32.png" rel="icon" />
    <link rel="stylesheet" href="{{asset('adminR/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminR/vendors/base/vendor.bundle.base.css')}}">
  
  <link rel="stylesheet" href="{{asset('adminR/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('adminR/css/style.css')}}">
  <link rel="shortcut icon" href="{{asset('adminR/images/favicon.png')}}" />
  <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>

  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <div class="container-scroller">
        @include('layouts.include.admin.navbar')
        <div class="container-fluid page-body-wrapper">
        @include('layouts.include.admin.sidebar')
            <div class="main-panel">
            <div>
                <br>
            <center><div class="w-50">
                @if (session()->has('danger'))
                    <div class="alert alert-danger" role="alert">
                        <span>{{ session()->get('danger') }}!</span>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}!
                    </div>
                @endif
                @if (session()->has('warning'))
                    <div class="alert alert-warning" role="alert">
                        {{ session()->get('warning') }}!
                    </div>
                @endif
            </div>
            </center>
            </div>
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>



<!-- plugins:js -->
<script src="{{asset('adminR/vendors/base/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{asset('adminR/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('adminR/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{asset('adminR/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('adminR/js/off-canvas.js')}}"></script>
  <script src="{{asset('adminR/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('adminR/js/template.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('adminR/js/dashboard.js')}}"></script>
  <script src="{{asset('adminR/js/data-table.js')}}"></script>
  <script src="{{asset('adminR/js/jquery.dataTables.js')}}"></script>
  <script src="{{asset('adminR/js/dataTables.bootstrap4.js')}}"></script>
  <!-- End custom js for this page-->
  <!--Alpine js-->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <script src="{{asset('adminR/js/jquery.cookie.js')}}" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>