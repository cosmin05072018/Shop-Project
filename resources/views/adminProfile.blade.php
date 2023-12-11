@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/detailsProduct.css') }}">

    <div class="container min-vh-100 d-flex justify-content-center align-items-center text-white">
        <div class="container pt-4">
            <button class="optionsBtn btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop"
                    aria-controls="staticBackdrop">
                Options
            </button>
            <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="staticBackdropLabel">Options</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div>
                        <nav class="navbar">
                            <div class="container-fluid border border-3 rounded mb-2">
                                <a class="navbar-brand d-flex align-items-center justify-content-between w-100" href="{{ route('dashboard') }}">
                                    Home
                                    <i class="bi bi-house-door-fill"></i>
                                </a>
                            </div>
                            <div class="container-fluid border border-3 rounded mb-2">
                                <a class="navbar-brand d-flex align-items-center justify-content-between w-100" href="{{ route('viewProducts') }}">
                                    View Products
                                    <i class="bi bi-backspace-fill"></i>
                                </a>
                            </div>
                            <div class="container-fluid border border-3 rounded mb-2">
                                <a class="navbar-brand d-flex align-items-center justify-content-between w-100" href="{{ route('addProduct') }}">
                                    Add Products
                                    <i class="bi bi-database-fill-add"></i>
                                </a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            @foreach($adminProfile as $admin)
                <div class="container rounded bg-white mt-5 mb-5 text-black">
                    <div class="row d-flex align-items-center justify-content-around">
                        <div class="col-md-3 border-right">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img class="card-img" src="{{ asset('storage/photos/' . $admin['image']) }}">
                                <span class="text-black-50 mt-3">{{$admin['email']}}</span>
                            </div>
                        </div>
                        <div class="col-md-5 border-right">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right text-black">Profile Settings</h4>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="labels">Name</label>
                                        <input type="text" disabled class="form-control" placeholder="first name" value="{{$admin['firstName']}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Surname</label>
                                        <input type="text" disabled class="form-control" value="{{$admin['lastName']}}" placeholder="surname">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels">Mobile Number</label>
                                        <input type="text" disabled class="form-control" placeholder="enter phone number" value="0{{$admin['phone']}}">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Address</label>
                                        <input type="text" disabled class="form-control" placeholder="enter address line 1" value="{{$admin['address']}}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="labels">Country</label>
                                        <input type="text" disabled class="form-control" placeholder="country" value="{{$admin['country']}}"></div>
                                    <div class="col-md-6">
                                        <label class="labels">City</label>
                                        <input type="text" disabled class="form-control" value="{{$admin['city']}}" placeholder="City">
                                    </div>
                                </div>
                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary profile-button disabled" type="button">Save Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
