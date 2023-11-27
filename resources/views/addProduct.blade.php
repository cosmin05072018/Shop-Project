@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/addProducts.css') }}">

    <div class="container">
        <button class="btn bg-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop"
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
                    <nav class="navbar ">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="{{ route('dashboard') }}">Home</a>
                        </div>
                        <div class="container-fluid">
                            <a class="navbar-brand" href="{{ route('viewProducts') }}">View Products</a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card border-0 mt-3">
            <div class="card-body">
                <div class="card border-0">
                    <div class="card-body">
                        <form action="{{ route('addProductDataBase') }}" method="POST" enctype="multipart/form-data"
                            class="p-5 rounded">
                            @csrf
                            <h1 class="card-title text-center mb-5">Add Product</h1>
                            <div class="form-group row d-flex align-items-center">
                                <label for="Title" class="col-sm-2 col-form-label text-center"><b
                                        class="fs-3">Title</b></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Title" value="{{ old('title') }}"
                                        name="title" placeholder="Enter Title Food">
                                    @error('title')
                                        <div class="mt-1 w-100 p-1 text-center"><b>{{ $message }}</b></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-5 d-flex align-items-center">
                                <label for="Description" class="col-sm-2 col-form-label text-center"><b
                                        class="fs-3">Description</b></label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="Description" name="description" rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="mt-1 w-100 p-1 text-center"><b>{{ $message }}</b></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-5 d-flex align-items-center">
                                <label for="Price" class="col-sm-2 col-form-label text-center"><b
                                        class="fs-3">Price</b></label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" value="{{ old('price') }}" name="price"
                                        id="Price" placeholder="Enter Price Food">
                                        @error('price')
                                            <div class="mt-1 w-100 p-1 text-center"><b>{{ $message }}</b></div>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-5 d-flex align-items-center">
                                <label for="Category" class="col-sm-2 col-form-label text-center"><b
                                        class="fs-3">Category</b></label>
                                <div class="col-sm-10">
                                    <select name="category" id="date_filter" class="form-control">
                                        <option value="" selected>Select category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{{ $category['category'] }}}">{{ $category['category']}}</option>
                                        @endforeach
                                    </select>
                                        @error('category')
                                            <div class="mt-1 w-100 p-1 text-center"><b>{{ $message }}</b></div>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-5 d-flex align-items-center">
                                <label for="Image" class="col-sm-2 col-form-label text-center"><b
                                        class="fs-3">Image</b></label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="formFile" name="image">
                                    @error('image')
                                            <div class="mt-1 w-100 p-1 text-center"><b>{{ $message }}</b></div>
                                        @enderror
                                </div>
                            </div>
                            <div class="button d-flex justify-content-center">
                                <button type="submit" class="btn optionsBtn w-0 mt-4">Insert Product in DataBase</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
