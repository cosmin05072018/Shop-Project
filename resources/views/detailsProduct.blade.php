@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/detailsProduct.css') }}">

@section('content')
    <div class="container min-vh-100 d-flex justify-content-center align-items-center text-white">
        <div class="container pt-4">
            <button class="optionsBtn btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop"
                    aria-controls="staticBackdrop">
                Options
            </button>
            <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop"
                 aria-labelledby="staticBackdropLabel">
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
                                    Back
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
            <div class="container mt-5 mb-5">
                <div class="card border-0">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="d-flex flex-column justify-content-center">
                                <div class="main_image"><img class="w-100"
                                                             src="{{ asset('storage/photos/' . $product->image) }}"
                                                             id="main_product_image">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-around">
                            <div class="p-3 right-side">
                                <div>
                                    <h1>Title</h1>
                                    <h3>{{ $product->title }}</h3>
                                </div>
                                <div class="mt-4 pr-3 content">
                                    <h1>Description</h1>
                                    <p>{{ $product->description }}</p>
                                </div>
                                <div class="mt-4 pr-3 content">
                                    <h1>Price</h1>
                                    <p>{{ $product->price . ' $' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
