@extends('master')
@section('content')
@include('partials.header')
@include('partials.side-bar')
		<!--Container Main start-->
	<div class="height-100 bg-light scroll-bar-style">
		<div class="container pt-4">
			<div class="row">
				<div class="col-md-4">
					<h3>Posts</h3>
				</div>
				<div class="col-md-8 text-md-end mb-3">
					<button type="button" class="btn btn-success me-md-2 gradient-btn" data-bs-toggle="modal" data-bs-target="#customCreateaiPostModal">
						<i class="bx bx-atom bx-spin bx-rotate-90"></i>
						Create with AI
					</button>
					<button type="button" class="btn btn-success gradient-btn" data-bs-toggle="modalai" data-bs-target="#customCreateaiPostModal">Create New</button>
				</div>
				<div class="col-md-4">
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Search posts (1)" aria-label="Search" aria-describedby="search-button">
					</div>
				</div>
			</div>
		</div>
		{{-- <div class="container pt-4">
			<div class="row col-md-10">
				<!-- Add this card structure for a post -->
				<div class="col-md-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">
								<h5 class="card-title">Zaid Ehsan</h5>
								<div class="dropdown">
									<button class="btn btn-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="bx bx-dots-horizontal-rounded"></i>
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="#">Edit Post</a>
										<a class="dropdown-item" href="#">Delete Post</a>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<img src="{{ asset('images/boy.png') }}" class="card-img-top" alt="Post Image" height="200px">
					</div>
				</div>
			</div>
		</div> --}}
		<!-- Modal for Create Post -->
		{{-- <div class="modal modal-fullscreen  fade" id="customCreatePostModal" tabindex="-1" role="dialog" aria-labelledby="customCreatePostModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">

			</div>
		</div> --}}
		<div class="modal fade" id="customCreateaiPostModal" tabindex="-1" role="dialog" aria-labelledby="customCreateaiPostModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen">
			  <div class="modal-content">
				<div class="modal-header">
				  <h5 class="modal-title" id="customCreateaiPostModalLabel">Create Posts</h5>
				  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
				  <div class="container-fluid">
					<div class="row">
					  <div class="col-md-6">
						<!-- First Section Content -->
						<div class="socail-select-icons">
							<div class="social-images">
								<span class="social-icon-container">
									<img src="{{ asset('images/facebook.svg') }}" class="social-image social-opacity" id="facebook-image" onclick="toggleVisibility('Facebook', this)">
									<svg id="icon-fb" class="icon-tick icon-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
										<path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path>
										<path d="M9.999 13.587 7.7 11.292l-1.412 1.416 3.713 3.705 6.706-6.706-1.414-1.414z"></path>
									</svg>
								</span>
								<span class="social-icon-container">
									<img src="{{ asset('images/linkedin.svg') }}" class="social-image social-opacity" id="linkedin-image" onclick="toggleVisibility('LinkedIn', this)">
									<svg id="icon-ln"  class="icon-tick icon-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="M9.999 13.587 7.7 11.292l-1.412 1.416 3.713 3.705 6.706-6.706-1.414-1.414z"></path></svg>
								</span>
								<span class="social-icon-container">
									<img src="{{ asset('images/instagram.svg') }}" class="social-image social-opacity"  id="instagram-image" onclick="toggleVisibility('Instagram', this)">
									<svg id="icon-ig"  class="icon-tick icon-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="M9.999 13.587 7.7 11.292l-1.412 1.416 3.713 3.705 6.706-6.706-1.414-1.414z"></path></svg>
								</span>
								<span class="social-icon-container">
									<img src="{{ asset('images/google-buisness.svg') }}" class="social-image social-opacity"  id="instagram-image" onclick="toggleVisibility('Instagram', this)">
									<svg id="icon-ig"  class="icon-tick icon-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="M9.999 13.587 7.7 11.292l-1.412 1.416 3.713 3.705 6.706-6.706-1.414-1.414z"></path></svg>
								</span>
							</div>
						</div>
                        <hr>
						<input type="hidden" id="selected-platform">
                        <div>
                            <form>
                                <div class="mb-3">
                                    <label for="customPostContent1" class="form-label">General</label>
                                    <div class="icon-container">
										<div class="textarea-field">
											<textarea class="form-control resize-none" id="postdata" placeholder="Your Text Here" aria-describedby="emailHelp" oninput="LivePreview()" rows="5"></textarea>
										</div>
                                        <div class="add-to-post-icons">
                                            <div class="photo-video" onclick="openFileInput()">
												<input type="file" class="form-photo" id="imageInput" accept="image/*" onchange="previewImage()">
											</div>
                                            <div class="feeling-activity"></div>
                                            <div class="gif"></div>
                                            <div class="chat-gpt-icon">
                                                <img src="{{ asset('images/chat-gpt.svg') }}" alt="icon">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
					  </div>
					  <div class="col-md-6">
							<!-- Second Section Content -->
							<h5>Post Preview</h5>
							{{-- <div class="facebook-preview">
								<div class="preview-body">
									<div class="linkedin-post">
										<img src="https://cdn.publer.io/profile-avatar.png" alt="Profile Picture" class="linkedin-post-profile-icon linkedin-img">
										<h3 class="h-postname">Ahad Latif</h3>
										<br>
										<div class="post-content">
											<p id="preview-text"></p>
										</div>
										<div id="imagePreview" class="image-post-preview"></div>
										<div class="box-icons">
											<i class='bx bxs-like'></i>
											<i class='bx bxs-comment'></i>
											<i class='bx bxs-share'></i>
										</div>
									</div>
								</div>
							</div> --}}
							<div class="facebook-preview">
								<div class="preview-body">
									<div class="linkedin-post">
										<img src="https://cdn.publer.io/profile-avatar.png" alt="Profile Picture" class="linkedin-post-profile-icon linkedin-img">
										<h3 class="h-postname">Ahad Latif</h3>
										<br>
										<div class="post-content">
											<p id="preview-text"></p>
										</div>
										<hr>
										<div class="facebook-preview-icons">
											<img src="{{ asset('images/facebook-like.svg') }}" alt="facebook like" width="20">
											<img src="{{ asset('images/facebook-love.svg') }}" alt="facebook like" width="20">
											<div class="facebook-reactions">
												<div class="facebook comments text-muted">
													128 comments
												</div>
												<div class="facebook-shares text-muted ">
													38 shares
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
                      </div>
					</div>
				  </div>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				  <button type="button" class="btn btn-success">Create Post</button>
				</div>
			  </div>
			</div>
		  </div>

	</div>
@endsection
<script>
	function LivePreview() {
		var inputValue = document.getElementById('postdata').value;
		document.getElementById('preview-text').innerText = inputValue;
	}

	const selectedPlatforms = [];

	function toggleVisibility(platform, clickedElement) {
        const iconElement = clickedElement.closest('.social-icon-container').querySelector('.icon-tick');
        const dataId = clickedElement.closest('.social-icon-container').getAttribute('data-id');
        iconElement.classList.toggle('icon-none');
        if (iconElement.classList.contains('icon-none')) {
            delete selectedPlatforms[platform];
        } else {
            selectedPlatforms[platform] = dataId;
        }
        console.log('Selected Platforms:', Object.keys(selectedPlatforms));
		const socialImage = clickedElement;
        socialImage.style.opacity = iconElement.classList.contains('icon-none') ? 0.7 : 1;
    }

	function openFileInput() {
            document.getElementById('imageInput').click();
        }

		function previewImage() {
            var input = document.getElementById('imageInput');
            var preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var image = document.createElement('img');
                    image.src = e.target.result;
                    image.style.maxWidth = '100%';
                    image.style.height = '100%';
                    preview.innerHTML = '';
                    preview.appendChild(image);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>