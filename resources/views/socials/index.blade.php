@extends('master')
@section('content')
@include('partials.header')
@include('partials.side-bar')
<style>
    .pages-connect-buttons-section{
        display: inline-flex;
    }
    .page-connect-button {
        background-color: #fff; /* Orange background, adjust the color as needed */
        color: #000; /* White text */
        padding: 20px; /* Padding inside the button */
        border: none; /* No border */
        text-align: center; /* Centered text */
        text-decoration: none; /* No underline on the text */
        display: block; /* Block display to allow width and height */
        font-size: 16px; /* Adjust the font size as needed */
        margin: 10px 10px; /* Margin around the button, auto for horizontal centering */
        cursor: pointer; /* Mouse cursor as pointer */
        border-radius: 10px; /* Rounded corners, adjust as needed */
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.2); /* Adding some shadow */
        width: 120px; /* Width of the button, adjust as needed */
        height: 120px; /* Height of the button, adjust as needed */
        position: relative; /* To position the icon and text inside the button */
        overflow: hidden; /* Ensure nothing spills out */
    }
    .page-connect-button-active{
        background-color: #e3e3e3 !important;
    }

  .page-connect-button:hover {
    background-color: #e3e3e3; /* Darker orange color on hover */
  }

  .page-connect-button img {
    max-width: 60px; /* Maximum width of the image */
    max-height: 60px; /* Maximum height of the image */
    position: absolute; /* To position it inside the button */
    top: 20px; /* Distance from the top */
    left: 50%; /* Start from the middle */
    transform: translateX(-50%); /* Center the image exactly */
  }

  .page-connect-button .text {
    position: absolute;
    bottom: 10px;
    left: 1%;
    width: 100%;
    text-align: center;
  }
  .modal-social-entities-listing-section{
    max-height: 300px;
    overflow-y: scroll;
  }

  .entity-active{
    background-color: #e3e3e3;
  }
  
</style>   
<div class="height-100 bg-light">
    <div class="container mt-5">
        <div class="col-md-8 text-md-end mt-3 position-button">
            <button type="button" class="btn btn-success gradient-btn" data-bs-toggle="modal" data-bs-target="#customCreateaiPostModal">Connect</button>
        </div>
        <div class="profile-text">
            <h3>Socials</h3>
            <p>Your Profiles</p>
        </div>
        <div class="container-fluid">
            @foreach($connectedSocials as $key => $connectedSocial)
                <div class="card" style="width: 100%;">
                    <h5 class="card-header">
                        @if($key == 'FACEBOOK')
                            <span>
                                <img src="{{ asset('images/facebook.svg') }}" style="width: 2%; margin-bottom: 5px;" class="card-img-top" alt="Social Platform 1 Icon">
                                FACEBOOK
                            </span>
                        @elseif($key == 'LINKEDIN')
                            <span>
                                <img src="{{ asset('images/linkedin.svg') }}" style="width: 2%; margin-bottom: 5px;" class="card-img-top" alt="Social Platform 2 Icon">
                                LINKEDIN
                            </span>
                        @endif    
                    </h5>
                    <div class="card-body pb-3">
                        <div class="row">
                            @forelse($connectedSocial as $social)
                                <div class="card col-md-3" style="padding:10px 20px;">
                                    <img src="{{$social->photo}}" class="rounded-circle mb-3" style="width: 60px; box-shadow: 0 4px 8px #5fcfad; padding:5px;" alt="social" />

                                    <h5 class="mb-2"><strong>{{ $social->title }}</strong></h5>
                                    <p class="text-muted">{{ \Carbon\Carbon::parse($social->created_at)->diffForHumans() }}</p>
                                </div>    
                            @empty
                                <p>No Record found</p>
                            @endforelse  
                        </div>    
                    </div>  
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="modal fade" id="customCreateaiPostModal" tabindex="-1" role="dialog" aria-labelledby="customCreateaiPostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customCreateaiPostModalLabel">Connect Plateforms</h5>
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
                            <a href="{{ route('instagram.connect') }}" class="btn custom-connect-btn">Connect</a>
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
    </div>
</div>

@include('socials.partials.fb-social-connect-modal')
@include('socials.partials.linkedin-social-connect-modal')
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            var url = window.location.href;
            var queryParams = new URLSearchParams(window.location.search);
            window.CONNECTSTATUS = queryParams.get('connectstatus');
            window.PROVIDER = queryParams.get('provider');

            if(window.PROVIDER == 'facebook') {
                $('#facebook-modal').modal('show');
            } 

            if(window.PROVIDER == 'linkedin') {
                $('#linkedin-modal').modal('show');
            } 
        });

    </script>
@endpush
