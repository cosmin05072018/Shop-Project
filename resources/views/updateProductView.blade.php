@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/detailsProduct.css') }}">

@section('content')
    <div class="container pt-4">
        <button class="optionsBtn btn mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop"
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
        <div class="card border-0">
            <div class="card-body">
                <div class="card border-0">
                    <div class="card-body ">
                        <form action="{{ route('updateProduct', [$productUpdate->id]) }}" method="POST" enctype="multipart/form-data" class="p-5 rounded">
                            @method('PATCH')
                            @csrf
                            <h1 class="card-title text-center mb-5">Edit Product</h1>
                            <div class="form-group row d-flex align-items-center">
                                <label for="Title" class="col-sm-2 col-form-label"><b class="fs-3">Title</b></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control {{ old('title') && !$errors->has('title') ? 'is-valid' : ($errors->has('title') ? 'is-invalid' : '') }}" id="Title"
                                        value="{{ old('title') ? old('title') : $productUpdate->title }}" name="title"
                                        placeholder="Enter Title Food">
                                    @error('title')
                                        <div class="mt-1 w-100 p-1"><b>{{ $message }}</b></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-5 d-flex align-items-center">
                                <label for="Description" class="col-sm-2 col-form-label"><b
                                        class="fs-3">Description</b></label>
                                <div class="col-sm-10">
                                    <textarea class="form-control form-control {{ old('description') && !$errors->has('description') ? 'is-valid' : ($errors->has('description') ? 'is-invalid' : '') }}" id="Description" name="description" rows="3">{{ old('description') ? old('description') : $productUpdate->description }}</textarea>
                                    @error('description')
                                        <div class="mt-1 w-100 p-1"><b>{{ $message }}</b></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-5 d-flex align-items-center">
                                <label for="Price" class="col-sm-2 col-form-label"><b class="fs-3">Price</b></label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control {{ old('price') && !$errors->has('price') ? 'is-valid' : ($errors->has('price') ? 'is-invalid' : '') }}"
                                        value="{{ old('price') ? old('price') : $productUpdate->price }}" name="price"
                                        id="Price" placeholder="Enter Price Food">
                                        @error('price')
                                        <div class="mt-1 w-100 p-1"><b>{{ $message }}</b></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-5 d-flex align-items-center">
                                <label for="Category" class="col-sm-2 col-form-label"><b class="fs-3">Category</b></label>
                                <div class="col-sm-10">
                                    <select name="category" id="date_filter" class="form-control {{ old('category') && !$errors->has('category') ? 'is-valid' : ($errors->has('category') ? 'is-invalid' : '') }}">
                                        @foreach ($categories as $category)
                                        <option value="{{ $category['category'] }}" {{ $productUpdate->category['category'] == $category['category'] ? 'selected' : '' }}>{{ $category['category'] }}</option>
                                        @endforeach
                                    </select>
                                        @error('category')
                                        <div class="mt-1 w-100 p-1"><b>{{ $message }}</b></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-5 d-flex align-items-center">
                                <label for="Image" class="col-sm-2 col-form-label"><b class="fs-3">Image</b></label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="formFile" name="image">
                                    @error('image')
                                        <div class="mt-1 w-100 p-1"><b>{{ $message }}</b></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="button d-flex justify-content-center">
                                <button type="submit" class="optionsBtn btn w-0 mt-4">Update Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
