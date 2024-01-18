<link rel="stylesheet" href="{{asset('css/navbar.css')}}">

<nav class="navbar navbar-expand-lg navbar-dark px-5 py-4 text-white">
    <div class="container-fluid">
        <h1 class="title m-auto"><a class="text-white" href="{{route('index')}}">Pizza Hot</a></h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto d-flex align-items-center justify-content-between">
                <li class="nav-item">
                    <a class="nav-link mx-2 active px-4 text-yellow rounded-pill" aria-current="page"
                       href="#">Reservations</a>
                </li>
                <li class="nav-item">
                   @if(\Request::route()->getName() == 'index')
                        <a class="nav-link mx-2 px-4 text-yellow rounded-pill" aria-current="page" href="{{route('menu')}}">Menu</a>
                    @else
                        <a class="nav-link mx-2 px-4 text-yellow rounded-pill" aria-current="page" href="{{route('index')}}">Home</a>
                   @endif
                </li>
                @if(\Request::route()->getName() == 'cart')
                    <li class="nav-item">
                        <a class="nav-link mx-2 px-4 text-yellow rounded-pill" aria-current="page" href="{{route('menu')}}">Menu</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link mx-2 px-4 text-yellow  rounded-pill" aria-current="page" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2 px-4 text-yellow rounded-pill" href="#">Book Table</a>
                </li>
                <li class="mx-3 d-flex align-items-center justify-content-between mx-5">
                    @if(\Request::route()->getName() != 'cart')
                    <a href="{{route('cart')}}"><i class="bi bi-cart mx-5 text-white" value="{{ count(session('idProducts', [])) }}"></i></a>
                    @endif
                    @if(session('user'))
                    <i class="bi bi-person mx-5">
                            <p class="user">Hello, {{session('user')}}</p>
                    </i>@endif
                </li>
                @if(\Request::route()->getName() == 'index')
                <li>
                    <a class="nav-link mx-2 px-5 text-white bg-yellow rounded-pill" href="{{route('menu')}}">Order Online</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
