@extends('master')
@section('content')
@include('partials.header')
@include('partials.side-bar')
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
            <div class="card" style="width: 100%; margin-top:20px !important">
                <h5 class="card-header">
                    @if($key == 'FACEBOOK')
                        <span class="social-header">
                            <img src="{{ asset('images/facebook.svg') }}" class="social-icon" alt="Social Platform 1 Icon">
                            FACEBOOK
                        </span>
                    @elseif($key == 'LINKEDIN')
                        <span class="social-header">
                            <img src="{{ asset('images/linkedin.svg') }}" class="social-icon" alt="Social Platform 2 Icon">
                            LINKEDIN
                        </span>
                    @elseif($key == 'INSTAGRAM')
                        <span class="social-header">
                            <img src="{{ asset('images/instagram.svg') }}" class="social-icon" alt="Social Platform 2 Icon">
                            INSTAGRAM
                        </span>
                    @elseif($key == 'GOOGLE')
                        <span class="social-header">
                            <img src="{{ asset('images/google-buisness.svg') }}" class="social-icon" alt="Social Platform 2 Icon">
                            GOOGLE BUSINESS
                        </span>
                    @endif
                </h5>
                <div class="card-body pb-3">
                    <div class="row">
                        @forelse($connectedSocial as $social)
                            <div class="card col-md-2 social-card position-relative" style="width: auto;">
                                <div class="d-flex align-items-center justify-content-end position-absolute bottom-0 end-0 mb-1 me-2">
                                    <!-- Active/Inactive Toggle -->
                                    <div class="form-check form-switch me-2">
                                        <input class="form-check-input custom-switch" type="checkbox" onclick="connectedSocialStatusChange('{{ $social->id}}', '{{ $social->status }}')" id="toggle-{{$social->id}}" {{$social->status ? 'checked' : ''}}>
                                        <label class="form-check-label" for="toggle{{$social->id}}"></label>
                                    </div>
                                    <i class='bx bxs-trash' onclick="connectedSocialDelete('{{ $social->id }}')" style='color:#d23f3f'></i>
                                </div>
                                <div class="d-flex align-items-center">
                                    <img src="{{$social->photo}}" class="rounded-circle mb-3 social-avatar  {{$social->status ? 'social-avatar-active' : 'social-avatar-inactive'}}" alt="social" />
                                    <div class="ms-3">
                                        <h5 class=" text-truncate" style="max-width: 180px;"><strong>{{ $social->title }}</strong></h5>
                                    </div>
                                </div>
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
                              <a href="{{ route('google.connect') }}" class="btn custom-connect-btn">Connect</a>
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
@include('socials.partials.instagram-social-connect-modal')
@include('socials.partials.google-social-connect-modal')
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

            if(window.PROVIDER == 'instagram') {
                $('#instagram-modal').modal('show');
            }

            if(window.PROVIDER == 'google') {
                $('#google-modal').modal('show');
            }
        });

        // TODO:: checkbox checked status maintaing when catch block runs
        function connectedSocialStatusChange(id, status) {
            confirmBefore('Are you sure to change the status?', 'Yes').then(() => {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('socials.change-status') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        status
                    },
                    success: function(response) {
                        if(response.status == 'success') {
                            if(status) {
                                $('#toggle-'+id).parent().parent().parent().parent().find('.social-avatar').addClass('social-avatar-active').removeClass('social-avatar-inactive');
                                return
                            }
                            $('#toggle-'+id).parent().parent().parent().parent().find('.social-avatar').removeClass('social-avatar-active').addClass('social-avatar-inactive');
                        }
                    }
                })
            }).catch((error) => {
                
            });
        }

        function connectedSocialDelete(id) {
            confirmBefore('Are you sure to delete?', 'Yes').then(() => {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('socials.delete') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                    },
                    success: function(response) {
                        if(response.status == 'success') {
                            $('#toggle-'+id).parent().parent().parent().remove();
                        }
                    }
                })
            }).catch((error) => {
                
            });
        }

    </script>
@endpush
