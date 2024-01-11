@extends('master')
@section('content')
<div class="container">
    <header class="header" id="header">
        <div class="header_toggle"> 
            <i class='bx bx-menu' id="header-toggle"></i> 
        </div>
        <div class="theme-icon">
            <i class='bx bx-moon' id="theme-icon"></i>
        </div>
        <!-- <div class="header_img"> 
            <img src="boy.png" alt=""> 
        </div> -->
             <!-- Dropdown Code -->
    <ul class="list-unstyled">
        <li class="dropdown ml-2">
            <a class="rounded-circle " href="#" role="button" id="dropdownUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md avatar-indicators avatar-online">
                    <img alt="avatar" src="{{ asset('images/logo.png') }}" class="rounded-circle">
                </div>
            </a>
            <div class="dropdown-menu pb-2" aria-labelledby="dropdownUser">
                <div class="dropdown-item">
                    <div class="d-flex py-2">
                        <div class="avatar avatar-md avatar-indicators avatar-online">
                            <img alt="avatar" src="{{ asset('images/logo.png') }}" class="rounded-circle">
                        </div>
                        <div class="ml-3 lh-1">
                                <h5 class="mb-0 profile-name">Social360</h5>
                                <p class="mb-0 email-color">social360@company.com</p>
                        </div>
                    </div>
                </div>
            <div class="dropdown-divider"></div>
            <div class="">
                <ul class="list-unstyled">
                    <li class="dropdown-submenu dropright-lg">
                        <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">
                            <span class="mr-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10" ></circle></svg></span><span> Status
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item text-success" href="#!">
                            Online
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-black-50" href="#!">
                                    Offline
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-info" href="#!">
                                    Away
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="#!">
                                    Busy
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                

                    <li>
                        <a class="dropdown-item" href="@@webRoot/pages/profile-edit.html">
  <span class="mr-1">
    
<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
  </span>Profile
                        </a>
                    </li>
                    <li>
<a class="dropdown-item" href="@@webRoot/pages/student-subscriptions.html"><span class="mr-2">
<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></span>Subscription
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#!">
  <span class="mr-2">
<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></span>Settings
                        </a>
                    </li>
                    
                
                </ul>
            </div>
            <div class="dropdown-divider"></div>
            <ul class="list-unstyled">
            <li>
                <a class="dropdown-item" href="@@webRoot/index.html">
<span class="mr-2">
<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-power"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg></span>Sign Out
                </a>
            </li>
        
        </ul>
            
        </div>
            </div>
        </li>
    </ul>
    <!-- End Dropdown Code -->
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class='bx bxs-cube-alt nav_logo-icon'></i> <span class="nav_logo-name">Social 360</span> </a>
                <div class="nav_list"> <a href="#" class="nav_link active"> <i class='bx bx-home nav_icon'></i> <span class="nav_name">Planner</span> </a>
                    <a href="#" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Socials</span> </a> 
                    <a href="#" class="nav_link"> <i class='bx bx-refresh nav_icon'></i> <span class="nav_name">Automation</span> </a> 
                    <a href="#" class="nav_link"> <i class='bx bx-shopping-bag  nav_icon'></i> <span class="nav_name">Ecommerce</span> </a> 
                    <a href="#" class="nav_link"> <i class='bx bx-bar-chart-alt nav_icon'></i> <span class="nav_name">Analytics</span> </a> 
                    <a href="#" class="nav_link"><i class='bx bx-wrench nav_icon'></i><span class="nav_name">AI Tool</span>
                    <a href="#" class="nav_link"> <i class='bx bx-cog nav_icon nav_icon'></i> <span class="nav_name">Settings</span> </a>     
                    </a>
                    <a href="#" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
                </div>
            </div>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="height-100 bg-light ">
        <div class="container pt-4">
            <div class="row">
             <h3>Posts</h3>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search posts (1)" aria-label="Search" aria-describedby="search-button">
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>    
    <!--Container Main end-->
    @endsection

    @push('script')
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
        
        const showNavbar = (toggleId, navId, bodyId, headerId) =>{
        const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId),
        bodypd = document.getElementById(bodyId),
        headerpd = document.getElementById(headerId)
        
        // Validate that all variables exist
        if(toggle && nav && bodypd && headerpd){
        toggle.addEventListener('click', ()=>{
        // show navbar
        nav.classList.toggle('show')
        // change icon
        toggle.classList.toggle('bx-x')
        // add padding to body
        bodypd.classList.toggle('body-pd')
        // add padding to header
        headerpd.classList.toggle('body-pd')
        })
        }
        }
        
        showNavbar('header-toggle','nav-bar','body-pd','header')
        
        /*===== LINK ACTIVE =====*/
        const linkColor = document.querySelectorAll('.nav_link')
        
        function colorLink(){
        if(linkColor){
        linkColor.forEach(l=> l.classList.remove('active'))
        this.classList.add('active')
        }
        }
        linkColor.forEach(l=> l.addEventListener('click', colorLink))
        
            // Your code to run since DOM is loaded and ready
        });
        document.addEventListener("DOMContentLoaded", function(event) {
            const themeToggle = document.querySelector(".theme-icon");
            const body = document.body;
    
            themeToggle.addEventListener("click", function() {
                body.classList.toggle("dark-mode");
    
                // Toggle the icon between sun and moon
                const currentIcon = themeToggle.querySelector("i");
                currentIcon.classList.toggle("bx-moon");
                currentIcon.classList.toggle("bx-sun");
            });
        });
    </script>
    @endpush
