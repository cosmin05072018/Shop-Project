@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboardCustom.css') }}">
    <nav class="navbar navbar-expand-lg navbar-dark p-3 text-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Hello, {{ $data['admin'] }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item">
                        <a class="nav-link mx-2 active" aria-current="page" href="{{ route('dashboard') }}">Home</a>
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
                    <li class="nav-item">
                        <a class="nav-link mx-2 " aria-current="page" href="#">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 " aria-current="page" href="{{ route('viewProducts') }}">View Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="{{ route('addProduct') }}">Add Products</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5 py-5 px-3 shadow-lg rounded">
        <div class="row g-3 my-2 text-white">
            <div class="col-md-3">
                <div class="cardComponent p-3 shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">720</h3>
                        <p class="fs-5">Products</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cardComponent p-3 shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">4920</h3>
                        <p class="fs-5">Sales</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cardComponent p-3 shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">3899</h3>
                        <p class="fs-5">Delivery</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cardComponent p-3 shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">%25</h3>
                        <p class="fs-5">Increase</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3 my-2 text-white">
            <div class="col-md-3">
                <div class="cardComponent p-3 shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">1250</h3>
                        <p class="fs-5">Clients</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cardComponent p-3 shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">100</h3>
                        <p class="fs-5">Employee</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cardComponent p-3 shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">5</h3>
                        <p class="fs-5">Chef Master</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container mt-5 py-5 px-3 bg-light shadow-lg bg-white rounded">
        <table id="table" class="ui celled table">
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
                        <td><img class="img-thumbnail" src="{{ asset('photos/' . $product->image) }}" alt=""></td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category }}</td>
                        <td>
                            <div class="buttons d-flex">
                                <button type="button" class="btn btn-danger px-3 m-1">Delete</button>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn bg-info bg-gradient text-dark px-3 m-1"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Update
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="title">Title</label>
                                                        <input type="text" class="form-control w-50" placeholder="Title">
                                                        <small id="emailHelp" class="form-text text-muted"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Description">Description</label>
                                                        <input type="text" class="form-control w-50"
                                                            placeholder="Description">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Price">Price</label>
                                                        <input type="text" class="form-control w-50" placeholder="Price">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Category">Category</label>
                                                        <input type="text" class="form-control w-50" placeholder="Category">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Image">Image</label>
                                                        <input type="text" class="form-control w-50" placeholder="Image">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div> --}}


    <link rel="stylesheet" href="{{ asset('css/adminCustom.css') }}">

    <img class="heroImg" src="{{ asset('photos/backgroundDashboard.jpg') }}" alt="">

    <script>
        $(document).ready(function() {
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
