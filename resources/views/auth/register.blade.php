@extends("auth.master")
@section("content")
    <div>
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @if (session('status'))
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
        @endif
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Your Logo" width="60px">
        </div>
        <h1 style="font-size: 24px;">Sign up to SM</h1>
        <p><span class="account-text">Already have an account?</span> <a href="{{route('auth.login')}}" class="get-started-link">Sign in</a></p>
        <a href="{{ route('google.redirect') }}"class="a">
            <button class="google-login-button">
                <svg width="1em" height="1em" viewBox="-3 0 262 262" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="text-base">
                    <path d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" fill="#4285F4"></path>
                    <path d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" fill="#34A853"></path>
                    <path d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782" fill="#FBBC05"></path>
                    <path d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" fill="#EB4335"></path>
                </svg>
                <div class="text-muted">
                    Continue with Google
                </div>
            </button>
        </a>
        <a href="{{ route('linkedin.redirect') }}"class="a">
            <button class="google-login-button">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 48 48">
                    <path fill="#0078d4" d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5	V37z"></path>
                    <path d="M30,37V26.901c0-1.689-0.819-2.698-2.192-2.698c-0.815,0-1.414,0.459-1.779,1.364	c-0.017,0.064-0.041,0.325-0.031,1.114L26,37h-7V18h7v1.061C27.022,18.356,28.275,18,29.738,18c4.547,0,7.261,3.093,7.261,8.274	L37,37H30z M11,37V18h3.457C12.454,18,11,16.528,11,14.499C11,12.472,12.478,11,14.514,11c2.012,0,3.445,1.431,3.486,3.479	C18,16.523,16.521,18,14.485,18H18v19H11z" opacity=".05"></path>
                    <path d="M30.5,36.5v-9.599c0-1.973-1.031-3.198-2.692-3.198c-1.295,0-1.935,0.912-2.243,1.677	c-0.082,0.199-0.071,0.989-0.067,1.326L25.5,36.5h-6v-18h6v1.638c0.795-0.823,2.075-1.638,4.238-1.638	c4.233,0,6.761,2.906,6.761,7.774L36.5,36.5H30.5z M11.5,36.5v-18h6v18H11.5z M14.457,17.5c-1.713,0-2.957-1.262-2.957-3.001	c0-1.738,1.268-2.999,3.014-2.999c1.724,0,2.951,1.229,2.986,2.989c0,1.749-1.268,3.011-3.015,3.011H14.457z" opacity=".07"></path><path fill="#fff" d="M12,19h5v17h-5V19z M14.485,17h-0.028C12.965,17,12,15.888,12,14.499C12,13.08,12.995,12,14.514,12	c1.521,0,2.458,1.08,2.486,2.499C17,15.887,16.035,17,14.485,17z M36,36h-5v-9.099c0-2.198-1.225-3.698-3.192-3.698	c-1.501,0-2.313,1.012-2.707,1.99C24.957,25.543,25,26.511,25,27v9h-5V19h5v2.616C25.721,20.5,26.85,19,29.738,19	c3.578,0,6.261,2.25,6.261,7.274L36,36L36,36z"></path>
                </svg>
                <div class="text-muted">
                    Continue with Linkedin 
                </div>
            </button>
        </a>
        <div class="or">
            <span class="text-muted">OR</span>
        </div>
        <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" class="email-input" placeholder="Enter your email">
        </div>
        <div class="password-field" id="passwordField">
            <i class="toggle-password fas fa-eye-slash" onclick="togglePassword()"></i>
            <input type="password" class="password-input" placeholder="Enter your password">
        </div>
        <button class="signin-button" id="signInButton" style="display: none;">Sign In</button>
        <br>
        <button class="send-link-button">Continue with email</button>
        <br>
        <p class="footer-paragraph">By continuing, you agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</p>
    </div>
@endsection
@push('script')
    <script>
        const passwordLink = document.getElementById('passwordLink');
        const passwordField = document.getElementById('passwordField');
        const signInButton = document.getElementById('signInButton');

        passwordLink.addEventListener('click', function(event) {
            event.preventDefault();

            if (passwordField.style.display === 'none') {
                passwordField.style.display = 'block';
                signInButton.style.display = 'block'; 
            } else {
                passwordField.style.display = 'none';
                signInButton.style.display = 'none'; 
            }
        });

        function togglePassword() {
            const passwordInput = document.querySelector('.password-input');
            const toggleIcon = document.querySelector('.toggle-password');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }
    </script>
@endpush