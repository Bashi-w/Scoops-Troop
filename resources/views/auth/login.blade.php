@extends('layouts.loginlayout')

@section('content')
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form method="POST" action="{{ route('register') }}">
            @csrf
			<h1>Create Account</h1>
			<!-- <div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div> -->
			<!-- <span>or use your email for registration</span> -->
			<div class="inputs">
			<div class="input-group">
                <span class="input-group-icon">
                    <i class="fas fa-user"></i> <!-- Replace with your desired icon class -->
                </span>
				<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

				@error('name')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
			<div class="address" style="display:grid; grid-template-columns:1fr 1fr 1fr; grid-gap:1em">
				<div class="input-group">
					<span class="input-group-icon">
						<i class="fas fa-house"></i> <!-- Replace with your desired icon class -->
					</span>
					<input id="house" type="text" class="form-control @error('house') is-invalid @enderror" name="house" value="{{ old('house') }}" required autocomplete="house" autofocus placeholder="House #">

					@error('house')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="input-group">
					<span class="input-group-icon">
						<i class="fas fa-street-view"></i> <!-- Replace with your desired icon class -->
					</span>
					<input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" required autocomplete="street" autofocus placeholder="Street">

					@error('street')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="input-group">
					<span class="input-group-icon">
						<i class="fas fa-city"></i> 
					</span>
					<input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus placeholder="City">

					@error('city')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>
			<div class="scond" style="display:grid; grid-template-columns:1fr 1fr; grid-gap:1em">
				<div class="input-group">
					<span class="input-group-icon">
						<i class="fas fa-phone"></i> 
					</span>
					<input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus placeholder="Mobile #">

					@error('mobile')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="input-group">
					<span class="input-group-icon">
						<i class="fas fa-cake-candles"></i> 
					</span>
					<input id="dob" type="date" class="form-control @error('city') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="dob" autofocus placeholder="D.O.B">

					@error('dob')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>
			
			<div class="input-group">
                <span class="input-group-icon">
                    <i class="fas fa-envelope"></i> <!-- Replace with your desired icon class -->
                </span>
				<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email Address">
				@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
			</div>
			<div class="input-group">
                <span class="input-group-icon">
                    <i class="fas fa-lock"></i> 
                </span>
				<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
				@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
			<div class="input-group">
                <span class="input-group-icon">
                    <i class="fas fa-lock"></i> 
                </span>
				<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
				
			</div>
			</div>
			
			<button type="submit">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form method="POST" action="{{ route('login') }}" id="loginForm">
			@csrf

			<!-- Display error message -->
			@if(session('error'))
				<div class="alert alert-danger">
					{{ session('error') }}
				</div>
			@endif
			<h1>Sign in</h1>
			<!-- <div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div> -->
			<!-- <span>or use your account</span> -->
			<div class="input-group">
                <span class="input-group-icon">
                    <i class="fas fa-envelope"></i> 
                </span>
				<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email Address">
				@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
			</div>
			<div class="input-group">
                <span class="input-group-icon">
                    <i class="fas fa-eye"></i> 
                </span>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password">
            
                @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <div class="input-group">
                <span class="input-group-icon">
                    <i class="fas fa-location-dot"></i>
                </span>
				<select id="branchOpt" class="form-control @error('region') is-invalid @enderror" name="branchOpt" required>
					<option value="" disabled selected>Select Branch</option>
					<!-- <option value="Central">Central</option>
					<option value="Western">Western</option> -->
					<!-- Branch options will be added here dynamically -->
				</select>

                @error('region')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

			<input id="branch" type="hidden" class="form-control @error('branch') is-invalid @enderror" name="branch" required placeholder="branch">

			<!-- Add a hidden input field to store the selected region value -->
			<!-- <input type="hidden" id="selectedRegion" name="selectedRegion" value="" /> -->
			<!-- <a href="#">Forgot your password?</a> -->
			<button type="submit">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>

<script>
    var branchOpt = document.getElementById('branchOpt');
    var branchInput = document.getElementById('branch');

    // Function to fetch branch data and populate the dropdown
    function loadBranches() {
        var branchUrl = '/branches'; 

        // Fetch branch data from the server
        fetch(branchUrl)
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                // Clear existing options
                branchOpt.innerHTML = '<option value="" disabled selected>Select Branch</option>';

                // Add branch options dynamically
                data.forEach(function (branch) {
                    var option = document.createElement('option');
                    option.value = branch.id; 
                    option.textContent = branch.location;
                    branchOpt.appendChild(option);
                });
            })
            .catch(function (error) {
                console.error('Error loading branches:', error);
            });
    }

    // Add an event listener to the select element
    branchOpt.addEventListener('change', function () {
        // Get the selected option's value
        var selectedBranch = branchOpt.value;

        // Set the selected branch in the input field
        branchInput.value = selectedBranch;
    });

    // Load branches when the page is ready
    document.addEventListener('DOMContentLoaded', function () {
        loadBranches();
    });
</script>




@endsection
