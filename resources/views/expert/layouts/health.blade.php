<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DSE</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{ asset('hsc.png')}}">



    {{--  datatables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap.min.css">
    
    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend/vendor/css/bootstrap-icons.css')}}" rel="stylesheet">
    {{-- <link href="{{ asset('frontend/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('frontend/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/remixicon/remixicon.css')}}" rel="stylesheet"> --}}
    <link href="{{ asset('frontend/vendor/css/simple-datatables/style.css')}}" rel="stylesheet">


</head>

<body>

    @include('expert.inc.header')
    @yield('content')
    @include('expert.inc.footer')

    <!-- jQuery -->

    
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
    
        <!-- Vendor JS Files -->
        <script src="{{ asset('frontend/vendor/js/apexcharts.min.js')}}"></script>
        <script src="{{ asset('frontend/vendor/js/chart.umd.js')}}"></script>
        <script src="{{ asset('frontend/vendor/js/echarts.min.js')}}"></script>
        <script src="{{ asset('frontend/vendor/js/quill.min.js')}}"></script>
        <script src="{{ asset('frontend/vendor/js/simple-datatables/simple-datatables.js')}}"></script>
        {{-- <script src="{{ asset('frontend/vendor/tinymce/tinymce.min.js')}}"></script>
        <script src="{{ asset('frontend/vendor/php-email-form/validate.js')}}"></script> --}}
    
    
        <script src="{{ asset('assets/admin/js/jquery.min.js')}}"></script>
        <script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>
        <script src="{{ asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('frontend/js/app.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
        <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script> 
        <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script> 
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script> 
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.bootstrap4.min.js"></script> 
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> 
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> 
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script> 
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script> 
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.colVis.min.js"></script> 
        @yield('script')
    
    </body>
    
    </html>