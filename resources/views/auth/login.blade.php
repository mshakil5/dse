<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login</title>
	<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('frontend/css/app.css')}}">
	<style>
		.login-head p {
			font-size: 0.8rem !important;
			color: red;
		}
	</style>
</head>

<body>

	<div class="login-section">

		<div class="login-box">
			<div class="brand">
				<p class="brand-text">DSE</p>

				@if (isset($message))
				<span class="login-head" role="alert">
					<strong>
						<p style="color: red">{{ $message }}</p>
					</strong>
				</span>
				@endif

			</div>
			<form class="login-element" method="POST" action="{{ route('login') }}">
				@csrf
				<div class="item-rows">
					<label for="email">Email:</label>
					<input id="email" type="email" class="form-item @error('email') is-invalid @enderror" name="email"
						required autocomplete="email" autofocus>

					@error('email')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
				<div class="item-rows">
					<label for="">Password:</label>
					<input id="password" type="password" class="form-item @error('password') is-invalid @enderror"
						name="password" required autocomplete="current-password">
					@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
				<div class="item-rows">
					<button type="submit" class='login-btn'>Login</button>
				</div>
			</form>
			<p class="register-link">
				Don't have an account <a href="{{ route('register') }}">Sign up!</a>
			</p>
		</div>

	</div>

</body>

</html>