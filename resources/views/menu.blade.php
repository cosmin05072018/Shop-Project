@extends('layouts.app')
@extends('layouts.navbar')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <div class="row g-0 my-5">
        <div class="col-3 col-md-2 mx-5">
            <div class="container bg-light rounded">
                <h3> <i class="bi bi-filter"></i> Filters</h3>
            </div>
        </div>
        <div class="col-sm-6 col-md-8">
            <div class="container bg-light rounded">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($products as $product)
                        <div class="col">
                            <div class="card h-100">
                                <img src="{{asset('storage/photos/' . $product['image']) }}" class="product-img card-img-top" alt="{{$product['title']}}">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{$product['title']}}</h5>
                                    <p class="card-text text-center">{{$product['price']}} $</p>
                                    <p class="card-text text-center">{{ Str::limit($product['description'], 40) }}</p>
                                    <button class="btn btn-add w-100 rounded-pill"> Add </button>
                                    <button class="btn btn-details w-100 rounded-pill mt-3"> View more details</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $products->links() }}
    </div>

    <script>
        $(document).ready(function() {
           //
        });
    </script>
@endsection
