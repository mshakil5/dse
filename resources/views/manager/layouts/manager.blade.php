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


    
    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend/vendor/css/bootstrap-icons.css')}}" rel="stylesheet">
    {{-- <link href="{{ asset('frontend/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('frontend/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/remixicon/remixicon.css')}}" rel="stylesheet"> --}}
    <link href="{{ asset('frontend/vendor/css/simple-datatables/style.css')}}" rel="stylesheet">


</head>

<body>

    @include('manager.inc.header')
    @yield('content')
    @include('manager.inc.footer')

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
    <script>
        document.addEventListener("DOMContentLoaded", () => {
          new ApexCharts(document.querySelector("#pieChart"), {
            series: [44, 55, 13, 43, 22],
            chart: {
              height: 350,
              type: 'pie',
              toolbar: {
                show: true
              }
            },
            labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E']
          }).render();
        });
      </script>
       <script>
        document.addEventListener("DOMContentLoaded", () => {
          new ApexCharts(document.querySelector("#columnChart"), {
            series: [{
              name: 'Net Profit',
              data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
            }, {
              name: 'Revenue',
              data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
            }, {
              name: 'Free Cash Flow',
              data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
            }],
            chart: {
              type: 'bar',
              height: 350
            },
            plotOptions: {
              bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
              },
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              show: true,
              width: 2,
              colors: ['transparent']
            },
            xaxis: {
              categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            yaxis: {
              title: {
                text: '$ (thousands)'
              }
            },
            fill: {
              opacity: 1
            },
            tooltip: {
              y: {
                formatter: function(val) {
                  return "$ " + val + " thousands"
                }
              }
            }
          }).render();
        });
      </script>
    @yield('script')

</body>

</html>