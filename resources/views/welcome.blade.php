@extends("master")
@section("content")
<body>
    <body id="body-pd">
      <header class="header" id="header">
          <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
          <div class="header_img"> <img src="boy.png" alt=""> </div>
      </header>
      <div class="l-navbar" id="nav-bar">
          <nav class="nav">
              <div> <a href="#" class="nav_logo"> <i class='bx bxs-cube-alt nav_logo-icon'></i> <span class="nav_logo-name">SM</span> </a>
                  <div class="nav_list"> <a href="#" class="nav_link active"> <i class='bx bx-home nav_icon'></i> <span class="nav_name">Planner</span> </a>
                      <a href="#" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Socials</span> </a> 
                      <a href="#" class="nav_link"> <i class='bx bx-refresh nav_icon'></i> <span class="nav_name">Automation</span> </a> 
                      <a href="#" class="nav_link"> <i class='bx bx-shopping-bag  nav_icon'></i> <span class="nav_name">Ecommerce</span> </a> 
                      <a href="#" class="nav_link"> <i class='bx bx-bar-chart-alt nav_icon'></i> <span class="nav_name">Analytics</span> </a> 
                      <a href="#" class="nav_link"><i class='bx bx-wrench nav_icon'></i><span class="nav_name">AI Tool</span>
                      <a href="#" class="nav_link"> <i class='bx bx-cog nav_icon nav_icon'></i> <span class="nav_name">Settings</span> </a>     
                      </a>
                  </div>
              </div>
              <a href="#" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
          </nav>
      </div>
      <!--Container Main start-->
      <div class="height-100 bg-light">
          <div class="container pt-4">
              <div class="row">
               <h3>Posts</h3>
                  <div class="col-md-4">
                      <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="search-button">
                      </div>
                  </div>  
              </div>
          </div>
      </div>
      <!--Container Main end-->
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
      </script>
  </body>