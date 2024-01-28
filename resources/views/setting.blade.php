@extends('master')
@section('content')
@include('partials.header')
@include('partials.side-bar')
<div class="height-100 bg-light">
    <div class="wrapper mt-sm-5">
        <h4 class="pb-4 border-bottom">Account settings</h4>
        <div class="d-flex align-items-start py-3 border-bottom">
            <img src="{{ asset('images/boy.png') }}"class="img img-fluid img-mobile" alt="">
            <div class="pl-sm-4 pl-2" id="img-section">
                <b>Profile Photo</b><br>
                <button class="btn button border"><b>Upload</b></button>
            </div>
        </div>
        <div class="py-2">
            <div class="row py-2">
                <div class="col-md-6">
                    <label for="firstname">First Name</label>
                    <input type="text" class="t form-control" placeholder="Zaid">
                </div>
                <div class="col-md-6 pt-md-0 pt-3">
                    <label for="lastname">Last Name</label>
                    <input type="text" class=" form-control" placeholder="Ehsan">
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-6">
                    <label for="email">Email Address</label>
                    <input type="text" class=" form-control" placeholder="steve_@email.com">
                </div>
                <div class="col-md-6 pt-md-0 pt-3">
                    <label for="phone">Password</label>
                    <input type="tel" class=" form-control" placeholder="123456789">
                </div>
            </div>
            <div class="py-3 pb-4 border-bottom">
                <button class="btn border button mr-3">Save Changes</button>
                <button class="btn border button">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection
