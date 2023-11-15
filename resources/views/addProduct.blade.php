@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Add Product</h1>
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="Title" class="col-sm-2 col-form-label"><b>Title</b></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Title"
                                        placeholder="Enter Title Product">
                                </div>
                            </div>
                            <div class="form-group row mt-5">
                                <label for="Description" class="col-sm-2 col-form-label"><b>Description</b></label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="Description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group row mt-5">
                                <label for="Price" class="col-sm-2 col-form-label"><b>Price</b></label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="price" id="Price"
                                        placeholder="Enter Price Product">
                                </div>
                            </div>
                            <div class="form-group row mt-5">
                                <label for="Category" class="col-sm-2 col-form-label"><b>Category</b></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Category"
                                        placeholder="Enter Category Product">
                                </div>
                            </div>
                            <div class="form-group row mt-5">
                                <label for="Image" class="col-sm-2 col-form-label"><b>Image</b></label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="formFile">
                                </div>
                            </div>
                            <div class="button d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary w-40 my-4">Insert Product in DataBase</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
