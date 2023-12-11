@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/dashboardCustom.css') }}">
    <nav class="navbar navbar-expand-lg navbar-dark p-3 text-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Hello, {{ $data['admin'] }}</a>
            @foreach($adminProfile as $admin)
                <img class="img-fluid rounded-circle" width="75px" src="{{ asset('storage/photos/' . $admin['image']) }}">
            @endforeach
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item">
                        <a class="nav-link mx-2 active" aria-current="page" href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 " aria-current="page" href="#">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 " aria-current="page" href="{{ route('viewProducts') }}">View Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="{{ route('addProduct') }}">Add Products</a>
                    </li>
                    <li class="nav-item dropdown me-5">
                        <a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Options
                        </a>
                        <ul class="dropdown-menu p-0" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item text-center" href="{{route('adminProfile')}}">Your Profile</a></li>
                            <li><a class="dropdown-item text-center" href="#">About Us</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger w-100" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="carouselExampleInterval" class="carousel slide mt-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($quotesAPI as $index => $quote)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" data-bs-interval="10000">
                    <h1 class="d-block w-100 text-center text-white">{{$quote['author']}}</h1>
                    <h3 class="d-block w-100 text-center text-white">"{{$quote['quote']}}"</h3>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <img class="heroImg" src="{{ asset('photos/backgroundDashboard.jpg') }}" alt="">

    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                "dom": 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                "columnDefs": [{
                    "targets": [1, 3, 6],
                    "orderable": false
                }],
                "language": {
                    "searchPlaceholder": "Search records",
                    "search": "",
                },
                "info": false
            });

            $('input[type="search"]').addClass('form-control rounded mb-5 px-3');
        });
    </script>
@endsection
