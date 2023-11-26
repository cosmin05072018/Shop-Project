@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/viewProducts.css') }}">

    <div class="container pt-4">
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
                            <a class="navbar-brand" href="{{ route('addProduct') }}">Add Products</a>
                        </div>
                    </nav>
                </div>
                <div class="mt-5">
                    <h1>Filters</h1>
                    <form action="{{ route('viewProducts') }}" method="get" class="mt-3">
                        <label for="Category" class="col-form-label"><b>Category</b></label>
                            <select name="date_filter" id="date_filter" class="form-select">
                                <option value="all" name="all"> All Categories </option>
                                @foreach ($categories as $category)
                                <option value="{{{ $category['category'] }}}">{{ $category['category']}}</option>
                                @endforeach
                            </select>
                            <label for="Search Product" class="col-form-label"><b>Search Product</b></label>
                        <input type="text" class="form-control" name="searchProduct" placeholder="Search Product...">
                        <label for="Price" class="col-form-label"><b>Price</b></label>
                        <button type="submit" class="btn btn-secondary ms-3 mt-5">Filter</button>
                    </form>
                </div>
            </div>
        </div>
        <table class="table mt-3" id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th>{{ $product->id }}</th>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->price . ' $' }}</td>
                        <td>{{ $product->category['category'] }}</td>
                        <td class="w-25">
                            <div class="d-flex justify-content-around align-items-center">
                                <button class="btn btn-primary"><a href="{{ route('detailsProduct', $product->id) }}"
                                        class="text-white">Details</a></button>
                                <button class="btn btn-warning"><a href="{{ route('updateProductView', $product->id) }}"
                                        class="text-white">Update</a></button>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Delete
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this product?
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="{{ route('deleteProduct', [$product->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger"> Yes </button>
                                        </form>
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
        <div class="mt-3 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "dom": 'frti',
                "columnDefs": [{
                    "targets": [3, 4],
                    "orderable": false
                }],
                "info": false,
                "searching": false
            });

            $("body").on("submit", ".addEditProduct", function(e) {
                e.preventDefault();
                const id = $(this).attr("id");
                $.ajax({
                    url: `update/${id}`,
                    type: "GET",
                    contentType: false,
                    processData: false,
                    headers: {
                        accepts: "application/json",
                    },
                    success: function(response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endsection
