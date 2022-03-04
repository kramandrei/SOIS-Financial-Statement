
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('public/assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('public/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
	  <link href="{{ asset('public/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/pace.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- loader-->
    <link href="{{ asset('public/assets/css/pace.min.css') }}" rel="stylesheet" />

    <style>
      
    </style>

    <!--Theme Styles-->
    <link href="{{ asset('public/assets/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/light-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/header-colors.css') }}" rel="stylesheet" />
    @stack('styles')
    <title>THE PROJECT</title>
</head>

<body>


  <!--start wrapper-->
  <div class="wrapper">
        @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
        @include('layouts.partials.nav')
        @include('layouts.partials.aside')
       

        <!--start content-->
        @yield('content')
        <!--end page main-->

        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        
        @include('layouts.partials.switcher')

  </div>
  @stack('modals')
  <!--end wrapper-->


  <!-- Bootstrap bundle JS -->
  <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
  <!--plugins-->
  <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('public/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
  <script src="{{ asset('public/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
  <script src="{{ asset('public/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('public/assets/js/pace.min.js') }}"></script>
  <script src="{{ asset('public/assets/plugins/select2/js/select2.min.js') }}"></script>
  <script src="{{ asset('public/assets/js/form-select2.js') }}"></script>
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <!--app-->
  <script src="{{ asset('public/assets/js/app.js') }}"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
  $('.datepicker').datepicker({
      uiLibrary: 'bootstrap5',
  });

  $('.table1').DataTable();
  
  </script>
  @stack('js')

</body>

</html>