<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Seiko Toko Online</title>
    <link rel="icon" href="storage/img/logo.png" type="image">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
    .sidebar {
        padding-top: 100px;
        width: 200px;
        background-color: #999DA0;
        position: fixed;
        height: 100%;
        overflow: auto;
    }

    .sidebar a {
        display: block;
        color: white;
        padding: 16px 0px 16px 16px;
        text-decoration: none;
    }

    .sidebar a.active {
        background-color: #04AA6D;
        color: white;
    }

    .sidebar a:hover:not(.active) {
        background-color: #777B7E;
        color: white;
    }

    div.content {
        margin-left: 200px;
        padding: 1px 16px;
        height: 1000px;
    }

    @media screen and (max-width: 700px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .sidebar a {
            float: left;
        }

        div.content {
            margin-left: 0;
        }
    }

    @media screen and (max-width: 400px) {
        .sidebar a {
            text-align: center;
            float: none;
        }
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #666666;">
        <div class="container">
            <a class="navbar-brand" href="{{url('/home')}}">
                <img src="storage/img/logo.png" alt="seiko" width="50px" class="d-inline-block align-text-center" />
            </a>
            <div class="top_bar_content ml-auto" style="float: right;">
                <div class="d-flex top_bar_user">
                    @if(Auth::guest())
                    <div style="margin-top: 15px;"><a href="{{ url('register') }}"
                            style="color: white; margin-right: 12px;"><i class="fa fa-user"></i> Register</a>
                    </div>
                    <div style="margin-top: 15px;"><a href="{{ url('login') }}" style="color: white;"> Login</a>
                    </div>
                    @else
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ url('/dashoard') }}" id="navarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;"><i
                                class="fa fa-user"></i>
                            {{Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="sidebar">
        <ul class="menu-content">
            <a href="{{url('/admin')}}"><i class="fa fa-home"></i> Dashboard</a>
            <a href="{{url('/adminuser')}}"><i class="fa-solid fa-user"></i>Data User</a>
            <a href="{{url('/adminproduk')}}"><i class="fa-solid fa-box-open"></i>Data Produk</a>
            <a href="{{url('/adminpesanan')}}"><i class="fa-solid fa-shopping-cart"></i>Data Pesanan</a>
            <a href="{{url('/adminongkir')}}"><i class="fa fa-shipping-fast"></i> Ongkir</a>
        </ul>
    </div>

    <main class="py-4">
        @yield('content')
    </main>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>