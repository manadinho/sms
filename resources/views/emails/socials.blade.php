@extends('master')
@section('content')
<header class="header" id="header">
    <div class="header_toggle">
        <i class="bx bx-menu" id="header-toggle"></i>
    </div>
    <div class="theme-icon">
        <i class="bx bx-moon" id="theme-icon"></i>
    </div>
    
    <!-- Dropdown Code -->
    @include('partials.dropdown')
    <!-- End Dropdown Code -->
</header>

@include('partials.side-bar')
<div class="container mt-5">
  <h3>Socials</h3>
  <div class="col-md-8 text-md-end mt-3 position-button">
    <button type="button" class="btn btn-success gradient-btn" data-bs-toggle="modal" data-bs-target="#customCreateaiPostModal">Create New</button>
  </div>
  <div class="profile-text">
    <p>Your Profiles</p>
  </div>
</div>
<div class="modal fade" id="customCreateaiPostModal" tabindex="-1" role="dialog" aria-labelledby="customCreateaiPostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customCreateaiPostModalLabel">Connect Plateform</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">    
            <div class="container mt-4">
              <div class="row">
                <div class="card">
                  <img src="{{ asset('images/instagram.svg') }}" style="width: 20%;" class="card-img-top mt-4 ml-4" alt="Social Platform 1 Icon">
                  <div class="card-body">
                    <h5 class="card-title">Instagram</h5>
                    <p class="card-text">Schedule and analyze posts on Instagram Business Profiles</p>
                    <a href="#" class="btn custom-connect-btn">Connect</a>
                  </div>
                </div>
          
                <div class="card">
                  <img src="{{ asset('images/facebook.svg') }}"  style="width: 20%;" class="card-img-top  mt-4 ml-4" alt="Social Platform 2 Icon">
                  <div class="card-body">
                    <h5 class="card-title">Facebook</h5>
                    <p class="card-text">Schedule and analyze posts on Facebook Pages or Groups</p>
                    <a href="{{ route('facebook.connect') }}" class="btn custom-connect-btn">Connect</a>
                  </div>
                </div>
          
                <div class="card">
                  <img src="{{ asset('images/linkedin.svg') }}" style="width: 20%;"  class="card-img-top mt-4 ml-4" alt="Social Platform 3 Icon">
                  <div class="card-body">
                    <h5 class="card-title">LinkedIn</h5>
                    <p class="card-text">Connect your LinkedIn Personal profiles or Company pages</p>
                    <a href="{{ route('linkedin.connect') }}" class="btn custom-connect-btn">Connect</a>
                  </div>
                </div>

                <div class="card">
                    <img src="{{ asset('images/twitter.svg') }}" style="width: 20%;" class="card-img-top mt-4 ml-4" alt="Social Platform 2 Icon">
                    <div class="card-body">
                      <h5 class="card-title">X.com(Twitter)</h5>
                      <p class="card-text">Schedule and analyze posts on Twitter accounts </p><br>
                      <a href="#" class="btn custom-connect-btn">Connect</a>
                    </div>
                </div>

                <div class="card">
                    <img src="{{ asset('images/google-buisness.svg') }}" style="width: 20%;" class="card-img-top  mt-4 ml-4" alt="Social Platform 2 Icon">
                    <div class="card-body">
                      <h5 class="card-title">Google Business</h5>
                      <p class="card-text">Schedule and analyze posts on your Google Business Profile</p><br>
                      <a href="#" class="btn custom-connect-btn">Connect</a>
                    </div>
                </div>

              </div>
                </div>
            </div>
</div>

@endsection
@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const showNavbar = (toggleId, navId, bodyId, headerId) =>
            {
                const toggle = document.getElementById(toggleId),
                nav = document.getElementById(navId),
                bodypd = document.getElementById(bodyId),
                headerpd = document.getElementById(headerId)
                if(toggle && nav && bodypd && headerpd){
                    toggle.addEventListener('click', ()=>{
                    nav.classList.toggle('display-sidebar')
                    toggle.classList.toggle('bx-x')
                    bodypd.classList.toggle('body-pd')
                    headerpd.classList.toggle('body-pd') })
                }
            }
        showNavbar('header-toggle','nav-bar','body-pd','header')
        const linkColor = document.querySelectorAll('.nav_link')
        function colorLink(){
            if(linkColor){
                linkColor.forEach(l=> l.classList.remove('active'))
                this.classList.add('active')
            }
        }
        linkColor.forEach(l=> l.addEventListener('click', colorLink))
        });
        document.addEventListener("DOMContentLoaded", function(event) {
            const themeToggle = document.querySelector(".theme-icon");
            const body = document.body;
            themeToggle.addEventListener("click", function() {
                body.classList.toggle("dark-mode");
                const currentIcon = themeToggle.querySelector("i");
                currentIcon.classList.toggle("bx-moon");
                currentIcon.classList.toggle("bx-sun");
            });
        });
    </script>
@endpush
