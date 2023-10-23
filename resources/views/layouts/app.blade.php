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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #666666;">
        <div class="container">
            <a class="navbar-brand" href="{{url('/home')}}">
                <img src="storage/img/logo.png" alt="seiko" width="50px" class="d-inline-block align-text-center" />
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="navbar-brand" href="{{ url('/produk') }}" style="color: white;">
                            Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="navbar-brand" href="{{ url('/ongkir') }}" style="color: white;">
                            Ongkir
                        </a>
                    </li>
                </ul>
            </div>
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
                                <a href="{{ url('editprofil') }}" class="dropdown-item">
                                    Edit Profile
                                </a>
                            </li>
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

    <main class="py-4">
        @yield('content')
    </main>
    </div>
</body>

</html>