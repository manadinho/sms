@extends("master")
@section("content")
<div>
    <div class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="Your Logo" width="60px">
    </div>
    <h1 style="font-size: 24px;">Sign in to SM</h1>
    <p><span class="account-text">Don't have an account?</span> <a href="signup.html" class="get-started-link">Get Started</a></p>
    <a href="{{ route('google.redirect') }}"class="a">
        <button class="google-login-button">
            <svg width="1em" height="1em" viewBox="-3 0 262 262" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="text-base">
                <path d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" fill="#4285F4"></path>
                <path d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" fill="#34A853"></path>
                <path d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782" fill="#FBBC05"></path>
                <path d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" fill="#EB4335"></path>
            </svg><div></div>
            Login with Google
        </button>
    </a>
    <div class="or">
        <span>OR</span>
    </div>
    <div class="input-field">
        <i class="fas fa-envelope"></i>
        <input type="email" class="email-input" placeholder="Enter your email">
    </div>
    <div class="password-field" id="passwordField">
        <i class="toggle-password fas fa-eye-slash" onclick="togglePassword()"></i>
        <input type="password" class="password-input" placeholder="Enter your password">
        <!-- <i class="toggle-password fas fa-eye-slash" onclick="togglePassword()"></i> -->
    </div>
    <button class="signin-button" id="signInButton" style="display: none;">Sign In</button>
    <br>
    <button class="send-link-button">Send me a magic Link</button>
    <br>
    <a href="#" class="sign" id="passwordLink"><h3>Sign in using password</h3></a>
    <p class="footer-paragraph">By continuing, you agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</p>
</div>
@endsection
@push('script')
<script>
    // JavaScript code to toggle the visibility of the password field and sign-in button
    const passwordLink = document.getElementById('passwordLink');
    const passwordField = document.getElementById('passwordField');
    const signInButton = document.getElementById('signInButton');

    passwordLink.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default link behavior

        // Toggle the display of the password field
        if (passwordField.style.display === 'none') {
            passwordField.style.display = 'block';
            signInButton.style.display = 'block'; // Show the sign-in button
        } else {
            passwordField.style.display = 'none';
            signInButton.style.display = 'none'; // Hide the sign-in button
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