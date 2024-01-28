<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Social 360</title>
</head>
<body id="body-pd">
    @yield('content')
    @stack('script')
    <!-- CONFIRM DILAOG CONTENT -->
    <div class="den-confirm-dialog">
    <div class="message">
        <h2>Warning!</h2>
        <p id="confirm-dialog-message">This is your message.</p>
        <div class="buttons">
            <button id="confirm-delete-btn">Delete</button>
            <button class="den-close-button" id="confirm-cancel-btn">Cancel</button>
        </div>
    </div>
    </div>
    <script>
        // todo:: refector this code use short opena close method to achieve DRY
        document.addEventListener("DOMContentLoaded", function(event) {
            const sidebarToggleElement = document.getElementById('header-toggle');
            let sidebarStatus = localStorage.getItem('sidebarStatus');
            if(!sidebarStatus | sidebarStatus == 'open'){
                localStorage.setItem('sidebarStatus', 'open');
                document.getElementById('nav-bar').classList.add('display-sidebar')
                sidebarToggleElement.classList.add('bx-x');
                document.getElementById('body-pd').classList.add('body-pd');
                document.getElementById('header').classList.add('body-pd');
            } else{
                document.getElementById('nav-bar').classList.remove('display-sidebar')
                sidebarToggleElement.classList.remove('bx-x');
                document.getElementById('body-pd').classList.remove('body-pd');
                document.getElementById('header').classList.remove('body-pd');
            }

            sidebarToggleElement.addEventListener('click', ()=>{
                if(sidebarStatus == 'open'){
                    sidebarStatus = 'close';
                    localStorage.setItem('sidebarStatus', 'close');
                    document.getElementById('nav-bar').classList.remove('display-sidebar')
                    sidebarToggleElement.classList.remove('bx-x');
                    document.getElementById('body-pd').classList.remove('body-pd');
                    document.getElementById('header').classList.remove('body-pd');
                } else{
                    sidebarStatus = 'open';
                    localStorage.setItem('sidebarStatus', 'open');
                    document.getElementById('nav-bar').classList.add('display-sidebar')
                    sidebarToggleElement.classList.add('bx-x');
                    document.getElementById('body-pd').classList.add('body-pd');
                    document.getElementById('header').classList.add('body-pd');
                }
            });

            const linkColor = document.querySelectorAll('.nav_link')
            function colorLink(){
                if(linkColor){
                    linkColor.forEach(l=> l.classList.remove('active'))
                    this.classList.add('active')
                }
            }
            linkColor.forEach(l=> l.addEventListener('click', colorLink))
        });

        // todo:: refector this code use short  methods to achieve DRY
        document.addEventListener("DOMContentLoaded", function(event) {
            const body = document.body;
            const themeToggle = document.querySelector(".theme-icon");
            let themeMode = localStorage.getItem('themeMode');

            if(!themeMode || themeMode === 'light') {
                themeMode = 'light';
                localStorage.setItem('themeMode', 'light');
                themeToggle.querySelector("i").classList.add("bx-moon");
            } else{
                themeToggle.querySelector("i").classList.add("bx-sun");
                body.classList.add("dark-mode");
            }


            themeToggle.addEventListener("click", function() {
                if(themeMode === 'light') {
                    themeMode = 'dark';
                    localStorage.setItem('themeMode', 'dark');
                    body.classList.add("dark-mode");
                    themeToggle.querySelector("i").classList.remove("bx-moon");
                    themeToggle.querySelector("i").classList.add("bx-sun");
                } else {
                    themeMode = 'light';
                    localStorage.setItem('themeMode', 'light');
                    body.classList.remove("dark-mode");
                    themeToggle.querySelector("i").classList.add("bx-moon");
                    themeToggle.querySelector("i").classList.remove("bx-sun");
                }
            });
        });

        function getLoaderComponent(){
            const imagesrc = "{{ asset('/images/loader/loader.gif') }}";
            return `<div style="display:flex; justify-content:center">
                    <img src="${imagesrc}" alt="Loading...">
                    </div>`;
        }

        function confirmBefore(message = null, delete_btn_txt = null) {
          return new Promise((resolve, reject) => {
            message ??= 'You will lose all of your data by deleting this. This action cannot be undone.';

            delete_btn_txt ??= 'Delete';

            document.querySelector('.den-confirm-dialog').style.visibility = 'visible';

            document.querySelector('#confirm-dialog-message').textContent = message;

            const cancelBtn = document.querySelector('#confirm-cancel-btn');

            const deleteBtn = document.querySelector('#confirm-delete-btn');

            deleteBtn.textContent = delete_btn_txt;

            cancelBtn.addEventListener('click', function() {
                document.querySelector('.den-confirm-dialog').style.visibility = 'hidden';
                reject();
            })

            deleteBtn.addEventListener('click', function() {
                document.querySelector('.den-confirm-dialog').style.visibility = 'hidden';
                resolve();
            })
          })

            
        }
    </script>
</body>
</html>
