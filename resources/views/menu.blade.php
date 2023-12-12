@extends('layouts.app')
@extends('layouts.navbar')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <div class="row g-0 my-5">
        <div class="col-3 col-md-2 mx-5">
            <div class="container bg-light rounded p-3">
                <form action="{{route('menu')}}" method="GET">
                <h1 class="colorOrange border-bottom pb-3"> <i class="bi bi-filter colorOrange"></i> Filters</h1>
                <div class="input-group rounded">
                    <input type="search" id="wordSearch" name="searchInput" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <button type="submit" class="btn"><i class="bi bi-search"></i></button>
                    </span>
                </div>
                <h2 class="text-bold">Category</h2>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="filter" id="flexRadioDefault1" value="all" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                        All
                    </label>
                </div>
                @foreach($categories as $category)
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="radio" name="filter" id="flexRadioDefault1" value="{{$category['category']}}" {{ request('filter') == $category['category'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{$category['category']}}">
                            {{$category['category']}} <span class="text-black-50">({{$category->products->count()}})</span>
                        </label>
                    </div>
                @endforeach
                    <button type="submit" class="btn btn-filter w-100 mt-3">Filter</button>
                </form>
            </div>
        </div>
        <div class="col-sm-6 col-md-8">
            <div class="container bg-light rounded">
                <div class="row row-cols-1 row-cols-md-3">
                    @if(!$products->count())
                        <div class="container w-100 text-center">
                            <h2>We couldn’t find anything. Try to search something else.</h2>
                        </div>
                    @endif
                    @foreach($products as $product)
                        <div class="col my-3">
                            <div class="card h-100">
                                <img src="{{asset('storage/photos/' . $product['image']) }}" class="product-img card-img-top" alt="{{$product['title']}}">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{$product['title']}}</h5>
                                    <p class="card-text text-center">{{$product['price']}} $</p>
                                    <p class="card-text text-center">{{ Str::limit($product['description'], 40) }}</p>
                                    <form action="{{route('addToCart', $product['id'])}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-add w-100">Add to cart</button>
                                    </form>
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
            //...
        });
    </script>
@endsection
