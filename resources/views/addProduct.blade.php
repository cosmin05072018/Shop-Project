@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/addProducts.css') }}">

    <img src="{{ asset('photos/backgroundAddProducts.jpg') }}" alt="backgroundAddProducts">
    <div class="container">
        <div class="card text-white border-0">
            <div class="card-body">
                <div class="card border-0">
                    <div class="card-body text-white">
                        <form action="{{ route('addProductDataBase') }}" method="POST" class="p-5 rounded">
                            @csrf
                            <h1 class="card-title text-center mb-5">Add Product</h1>
                            <div class="form-group row d-flex align-items-center">
                                <label for="Title" class="col-sm-2 col-form-label text-center"><b class="fs-3">Title</b></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Title" name="title"
                                        placeholder="Enter Title Food">
                                </div>
                            </div>
                            <div class="form-group row mt-5 d-flex align-items-center">
                                <label for="Description" class="col-sm-2 col-form-label text-center"><b class="fs-3">Description</b></label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="Description" name="description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group row mt-5 d-flex align-items-center">
                                <label for="Price" class="col-sm-2 col-form-label text-center"><b class="fs-3">Price</b></label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="price" id="Price"
                                        placeholder="Enter Price Food">
                                </div>
                            </div>
                            <div class="form-group row mt-5 d-flex align-items-center">
                                <label for="Category" class="col-sm-2 col-form-label text-center"><b class="fs-3">Category</b></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Category" name="category"
                                        placeholder="Enter Category Food">
                                </div>
                            </div>
                            <div class="form-group row mt-5 d-flex align-items-center">
                                <label for="Image" class="col-sm-2 col-form-label text-center"><b class="fs-3">Image</b></label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="formFile" name="image">
                                </div>
                            </div>
                            <div class="button d-flex justify-content-center">
                                <button type="submit" class="btn w-0 mt-4">Insert Product in DataBase</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
