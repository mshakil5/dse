<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> Login </title>
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
</head>

<body>

  <section class="section register min-vh-100  ">
    <div class="min-vh-100">
      <div class="row  min-vh-100 mx-0">
        <div class="col-md-8 mx-auto">

          <div class="row h-100 d-flex align-items-center justify-content-center">
            <div class="col-lg-6 mx-auto mb-4">
              <div class="d-flex justify-content-center py-4">
                <a href="#" class="logo d-flex align-items-center w-auto">
                  <img src="{{ asset('frontend/images/dselogo.PNG')}}" width="300px">
                </a>
              </div>
              <div class="card mb-3"> 
                <div class="card-body p-5"> 
                  <form class="row g-3 needs-validation" method="POST" action="{{ route('login') }}">
					@csrf


                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        {{-- <input type="text" name="username" class="form-control" id="yourUsername" required> --}}
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
							required autocomplete="email" autofocus>
							<div class="invalid-feedback">Please enter your email.</div>

						@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror


                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      {{-- <input type="password" name="password" class="form-control" id="yourPassword" required> --}}
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
						<div class="invalid-feedback">Please enter your password!</div>
						@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror


                    </div>

                    <div class="col-12 text-center">
                      <button class="btn  w-100 btn-theme " type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      {{-- <p class="small mb-0"> <a href="#" class="text-dark fw-bold">Reset Password</a></p> --}}
                    </div>
                  </form> 
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="d-none d-lg-flex col-lg-4 right-login-bg position-relative d-flex align-items-center">

          <div class="card shadow-sm rounded-4 overflow-hidden">
            <img src="https://picsum.photos/seed/picsum/300/100" class="img-fluid" alt="">

            <div class="card-body py-4">
              <h3 class="text-center text-capitalize">levelup your skill</h3>
              <h6 class="text-center ">sub title goes here </h6>
              <small class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                content. This content is a little bit longer.</small>
              <div class="d-flex justify-content-between align-items-center mt-4">
                <button class="btn btn-theme mx-auto text-uppercase"><small>visit the center</small></button>
              </div>
            </div>
          </div>

          <div class="p-4 position-absolute bottom-0 text-center start-0 end-0  fs-2">
            <a href="" class="text-white"><i class='bx bxl-facebook-circle'></i></a>
            <a href="" class="text-white"><i class='bx bxl-instagram-alt'></i> </a>
            <a href="" class="text-white"><i class='bx bxl-reddit'></i></a>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/admin/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets/admin/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{ asset('assets/admin/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{ asset('assets/admin/vendor/quill/quill.min.js')}}"></script>
  <script src="{{ asset('assets/admin/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{ asset('assets/admin/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{ asset('assets/admin/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/admin/js/main.js')}}"></script>

</body>

</html>
