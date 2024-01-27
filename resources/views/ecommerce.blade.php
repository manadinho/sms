@extends('master')
@section('content')
@include('partials.header')
@include('partials.side-bar')
<div class="height-100 bg-light">
    <div class="container mt-4">
        <div class="row">
            <div class="custom-card">
                <img src="{{ asset('images/shopify.svg') }}" style="width: 20%;" class="card-img-top mt-4 ml-4" alt="Social Platform 1 Icon">
                <div class="card-body">
                    <h5 class="card-title">Shopify</h5>
                    <p class="card-text">Connect to import your Shopify products and generate posts</p>
                    <a href="#" class="btn custom-connect-btn">Use</a>
                </div>
            </div>

            <div class="custom-card">
                <img src="{{ asset('images/woocommerce.svg') }}" style="width: 22%;" class="card-img-top  mt-4 ml-4" alt="Social Platform 2 Icon">
                <div class="card-body"><br>
                    <h5 class="card-title">WooCommerce</h5>
                    <p class="card-text">Connect to import your WooCommerc products and generate posts</p>
                    <a href="#" class="btn custom-connect-btn">Use</a>
                </div>
            </div>

            <div class="custom-card">
                <img src="{{ asset('images/etsy.svg') }}" style="width: 20%;" class="card-img-top mt-4 ml-4" alt="Social Platform 3 Icon">
                <div class="card-body">
                    <h5 class="card-title">Etsy</h5>
                    <p class="card-text">Connect to import your Etsy products and generate posts</p>
                    <a href="#" class="btn custom-connect-btn">Use</a>
                </div>
            </div>

            <!-- <div class="custom-card">
                <img src="bigcommerce-svgrepo-com.svg" style="width: 20%;" class="card-img-top mt-4 ml-4" alt="Social Platform 2 Icon">
                <div class="card-body">
                    <h5 class="card-title">BigCommerce</h5>
                    <p class="card-text">Connect to import your BigCommerce products and generate posts </p><br>
                    <a href="#" class="btn custom-connect-btn">Use</a>
                </div>
            </div>

            <div class="custom-card">
                <img src="ecwid.svg" style="width: 20%;" class="card-img-top  mt-4 ml-4" alt="Social Platform 2 Icon">
                <div class="card-body">
                    <h5 class="card-title">Ecwid</h5>
                    <p class="card-text">Connect to import your Ecwid products and generate posts</p><br>
                    <a href="#" class="btn custom-connect-btn">Use</a>
                </div>
            </div>

            <div class="custom-card">
                <img src="wixcommerce.svg" style="width: 20%;" class="card-img-top  mt-4 ml-4" alt="Social Platform 2 Icon">
                <div class="card-body">
                    <h5 class="card-title">WixCommerce</h5>
                    <p class="card-text">Connect to import your WixCommerce products and generate posts</p><br>
                    <a href="#" class="btn custom-connect-btn">Use</a>
                </div>
            </div> -->

        </div>
    </div>
</div>
@endsection
