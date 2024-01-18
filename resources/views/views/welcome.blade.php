@extends('master')
@section('content')
@include('partials.header')
@include('partials.side-bar')		
		<!--Container Main start-->
	<div class="height-100 bg-light">
		<div class="container pt-4">
			<div class="row">
				<div class="col-md-4">
					<h3>Posts</h3>
				</div>
				<div class="col-md-8 text-md-end mb-3">
					<button type="button" class="btn btn-success me-md-2 gradient-btn" data-bs-toggle="modal" data-bs-target="#customCreatePostModal">
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
		<div class="container pt-4">
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
						<img src="{{ asset('images/logo.png') }}" class="card-img-top" alt="Post Image" height="200px">
					</div>
				</div>
			</div>
		</div>     
		<!-- Modal for Create Post -->
		<div class="modal fade" id="customCreatePostModal" tabindex="-1" role="dialog" aria-labelledby="customCreatePostModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<select class="form-select form-select-sm" aria-label=".form-select-sm example">
							<option selected="">Select social profiles</option>
							<option value="1">Facebook</option>
							<option value="2">Instagram</option>
							<option value="3">LinkedIn</option>
						</select>
						<!-- Add your form elements here for post creation, including image upload -->
						<form>
							<div class="mb-3">
								<label for="customPostContent" class="form-label">General</label>
								<textarea class="form-control" id="customPostContent" rows="3"></textarea>
							</div>
							<div class="mb-3">
								<label for="customPostImage" class="form-label">Upload Image</label>
								<input type="file" class="form-control" id="customPostImage">
							</div>
						</form>
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
