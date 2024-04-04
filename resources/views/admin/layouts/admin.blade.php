<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>DSE - Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/admin/img/favicon.png')}}" rel="icon">
  <link href="{{ asset('assets/admin/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/admin/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/admin/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/admin/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/admin/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/admin/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/admin/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/admin/css/style.css')}}" rel="stylesheet">

  
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/admin/js/datatables/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/admin/js/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/admin/js/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="toggle-sidebar">

  <main id="main" class="main mt-0 py-0">
    <section class="section dashboard">
      <div class="row">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
          <div class="container-fluid">
            <a class="navbar-brand" href="{{route('admin.dashboard')}}">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="{{route('allmenu')}}">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
              </ul>
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                {{-- <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="{{ asset('assets/admin/img/logo.svg')}}" width="45px" height="45px" alt="" class="rounded-circle">
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                      <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </li> --}}

                <li class="nav-item d-none d-sm-inline-block">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
          
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
                </li>



              </ul>

            </div>
          </div>
        </nav>
      </div>
      <hr>


      @yield('content')
      


    </section>

  </main><!-- End #main -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>


  <!-- jQuery -->
  <script src="{{ asset('assets/admin/js/jquery.min.js')}}"></script>
  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/admin/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets/admin/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{ asset('assets/admin/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{ asset('assets/admin/vendor/quill/quill.min.js')}}"></script>
  <script src="{{ asset('assets/admin/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{ asset('assets/admin/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{ asset('assets/admin/vendor/php-email-form/validate.js')}}"></script>
  <script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>

  
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/admin/js/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatablesdataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatables/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatables/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatables/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/admin/js/main.js')}}"></script>


  <script>
    // page schroll top
    function pagetop() {
            window.scrollTo({
                top: 130,
                behavior: 'smooth',
            });
        }
  </script>
  @yield('script')


</body>

</html>