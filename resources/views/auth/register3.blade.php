<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Register</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{ asset('frontend/css/app.css')}}">
</head>

<body>


	<div class="login-section">

		<div class="login-box">
			<div class="brand">
				<!-- <img src="http://pngimg.com/uploads/starbucks/starbucks_PNG10.png" width="150px" height="auto"> -->
				<p class="brand-text">DSE</p>
			</div>
			<form class="login-element" method="POST" action="{{ route('register') }}">
                @csrf
				<div class="item-rows">
					<label for="">Full Name:</label>
                    <input id="name" type="text" class="form-item @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>

                <div class="item-rows">
					<label for="surname">Surname:</label>
                    <input id="surname" type="text" class="form-item @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                    @error('surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>
                
				<div class="item-rows">
					<label for="">Email:</label>
                    <input id="email" type="email" class="form-item @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>

				<div class="item-rows">
					<label for="">Password:</label>
                    <input id="password" type="password" class="form-item @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>
				<div class="item-rows">
					<label for="">Retype Password:</label>
                    <input id="password-confirm" type="password" class="form-item" name="password_confirmation" required autocomplete="new-password">
				</div>

				<div class="item-rows">
					<button type="submit" class='login-btn'>Register Now</button>
				</div>
			</form>
			<p class="register-link">
				Already Signup ? <a href='{{route('login')}}'> login!</a> Here
			</p>
		</div>

	</div>

	</div>




</body>

</html>