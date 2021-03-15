<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <title>Avontur | @yield('title')</title>

        <script src="{{ asset('assets/js/app.js') }}"></script>

        <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/costum.css') }}" rel="stylesheet" />
        @yield('header')
    </head>

    <body>
        <div class="d-flex toggled" id="wrapper">
            <!-- Sidebar -->
            <div class="side-nav border-right" id="sidebar-wrapper">
                <div class="user-info">
                    <img src="{{ asset('assets/img/no-photo.jpg') }}" alt="" />
                    {{strtoupper(session('loggedUser')->username)}}
                </div>
                <div class="time-container">
                    <span id="time"></span><br />
                    <span id="date"></span>
                </div>
                <div class="list-group list-group-flush slide-menu">
                    <a href="/dashboard" class="list-group-item list-group-item-action"
                        >Dashboard</a>
                    @if(session('loggedUser')->isAdmin == 1)
                    <a href="/produk" class="list-group-item list-group-item-action"
                        >Produk</a
                    >
                    <a href="/akun" class="list-group-item list-group-item-action"
                        >Akun</a
                    >
                    
                    <a href="/report" class="list-group-item list-group-item-action"
                        >Report</a
                    >
                    @endif
                </div>
                <a href="{{ route('auth.logout') }}">
                    <button class="logout">
                        <img
                            src="{{ asset('assets/img/power.png') }}"
                            alt=""
                            width="18"
                            height="18"
                        />
                        Logout
                    </button></a
                >
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav
                    class="navbar navbar-expand-lg navbar-light border-bottom top-nav"
                >
                    <div class="menu-bgr" id="menu-toggle">
                        <img
                            src="{{ asset('assets/img/Avontur.png') }}"
                            alt=""
                        />
                    </div>
                    <h2 class="mx-auto">WELCOME BACK</h2>
                    <span
                        >💈 Barbershop Jl. Pasteur No.29 Pasirkaliki,<br />
                        📍 Bandung - Jawa Barat</span
                    >
                </nav>
                <div class="container mt-2">
                <h1 class="page-header">@yield('pageheader')</h1>
                <div class="container-fluid">@yield('content')</div>
            </div>
            
        </div>
       
        <!-- Bootstrap core JavaScript -->
        <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/costum.js') }}"></script>

        
        @yield('script')
        <script>
            $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
    </body>
</html>
