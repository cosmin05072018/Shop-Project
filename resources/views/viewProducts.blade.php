@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/viewProducts.css') }}">

    <div class="container pt-4">
        <button class="btn bg-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
            Options
        </button>
        <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="staticBackdropLabel">Options</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div>
                    <nav class="navbar ">
                        <div class="container-fluid  border border-3 rounded mb-2">
                            <a class="navbar-brand d-flex align-items-center justify-content-between w-100" href="{{ route('dashboard') }}">
                                Home
                                <i class="bi bi-house-door-fill"></i>
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
                <div class="mt-5">
                    <h1>Filters</h1>
                    <form action="{{ route('viewProducts') }}" method="get" class="mt-3">
                        <label for="Category" class="col-form-label">
                            <b>Category</b>
                        </label>
                        <select name="category_filter" id="category_filter" class="form-select">
                            <option value="all" {{ request('category_filter', 'all') == 'all' ? 'selected' : '' }}>
                                All Categories ({{$totalProducts}})
                            </option>
                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category['category'] }}" {{ request('category_filter') == $category['category'] ? 'selected' : '' }}>{{ $category['category'] }} ({{$category->products->count()}})
                                </option>
                            @endforeach
                        </select>
                        <label for="Price" class="col-form-label mt-3">
                            <b>Price</b>
                        </label>
                        <div class="price-content">
                            <div>
                                <label>Min</label>
                                <p id="min-value"></p>
                            </div>
                            <div>
                                <label>Max</label>
                                <p id="max-value"></p>
                            </div>
                        </div>
                        <div class="range-slider">
                            <div class="range-fill"></div>
                            <input type="range" class="min-price" name="minValue" value="{{ $priceRange[0] }}" min="{{ $priceRange[0] }}" max="{{ $priceRange[1] }}"/>
                            <input type="range" class="max-price" name="maxValue" value="{{ $priceRange[1] }}" min="{{ $priceRange[0] }}" max="{{ $priceRange[1] }}"/>
                        </div>
                        <button type="submit" class="btn btn-secondary mt-3 w-100">Filter</button>
                    </form>
                </div>
            </div>
        </div>
        <table class="table mt-3" id="table">
            <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Title</th>
                <th scope="col" class="text-center">Price</th>
                <th scope="col" class="text-center">Category</th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="text-center">{{ $product->id }}</td>
                    <td class="text-center">{{ $product->title }}</td>
                    <td class="text-center">{{ $product->price . ' $' }}</td>
                    <td class="text-center">{{ $product->category['category'] }}</td>
                    <td>
                        <div class="d-flex justify-content-around align-items-center">
                            <button class="btn btn-primary w-25">
                                <a href="{{ route('detailsProduct', $product->id) }}" class="text-white d-flex align-items-center justify-content-between">
                                    Details
                                    <i class="bi bi-info-circle"></i>
                                </a>
                            </button>
                            <button class="btn btn-warning w-25">
                                <a href="{{ route('updateProductView', $product->id) }}" class="text-white d-flex align-items-center justify-content-between">
                                    Update
                                    <i class="bi bi-pass-fill"></i>
                                </a>
                            </button>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger w-25 d-flex align-items-center justify-content-between" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Delete
                                <i class="bi bi-trash"></i>
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
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                            </button>
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

        @if(session('statusUpdate'))
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto mr-1">Message</strong>
                        <i class="bi bi-chat-square-dots-fill"></i>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body text-white bg-success">
                        {{ session('statusUpdate') }}
                    </div>
                </div>
                @endif
                @if(session('statusDelete'))
                    <div class="toast-container position-fixed bottom-0 end-0 p-3">
                        <div id="liveToast" class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="me-auto mr-1">Message</strong>
                                <i class="bi bi-chat-square-dots-fill"></i>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body text-white bg-danger">
                                {{ session('statusDelete') }}
                            </div>
                        </div>
                        @endif
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('#table').DataTable({
                                "dom": 'frti',
                                "columnDefs": [{
                                    "targets": [3, 4],
                                    "orderable": false
                                }],
                                "info": false,
                                "searching": false
                            });

                            $("body").on("submit", ".addEditProduct", function (e) {
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
                                    success: function (response) {
                                        console.log(response);
                                    }
                                });
                            });
                        });

                        let minValue = document.getElementById("min-value");
                        let maxValue = document.getElementById("max-value");

                        const rangeFill = document.querySelector(".range-fill");

                        // Function to validate range and update the fill color on slider
                        function validateRange() {
                            let minPrice = parseInt(inputElements[0].value);
                            let maxPrice = parseInt(inputElements[1].value);

                            if (minPrice > maxPrice) {
                                let tempValue = maxPrice;
                                maxPrice = minPrice;
                                minPrice = tempValue;
                            }

                            const minPercentage = 100;
                            console.log(minPercentage);
                            const maxPercentage = 100;

                            rangeFill.style.left = minPercentage + "%";
                            rangeFill.style.width = maxPercentage - minPercentage + "%";

                            minValue.innerHTML = "$" + minPrice;
                            maxValue.innerHTML = "$" + maxPrice;
                        }

                        const inputElements = document.querySelectorAll("input");

                        // Add an event listener to each input element
                        inputElements.forEach((element) => {
                            element.addEventListener("input", validateRange);
                        });

                        // Initial call to validateRange
                        validateRange();
                    </script>
@endsection
