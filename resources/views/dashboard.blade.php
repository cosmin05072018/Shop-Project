@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Hello, {{ $data['admin'] }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class=" collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item">
                        <a class="nav-link mx-2 active" aria-current="page" href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="{{ route('addProduct') }}">Add Products</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Options
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Your Profile</a></li>
                            <li><a class="dropdown-item" href="#">About Us</a></li>
                            <li><a class="dropdown-item" href="#">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Logout</button>
                                    </form>
                                </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">image</th>
                    <th scope="col">title</th>
                    <th scope="col">description</th>
                    <th scope="col">price</th>
                    <th scope="col">category</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['products'] as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td><img class="img-thumbnail w-50" src="{{ asset('photos/images.png') }}" alt=""></td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category }}</td>
                        <td>
                            <div class="buttons d-flex">
                                <button type="button" class="btn btn-danger p-1 m-1">Delete</button>
                                <button type="button" class="btn btn-warning p-1 m-1">Update</button>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
