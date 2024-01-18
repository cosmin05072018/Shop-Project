@extends('layouts.footer')
@extends('layouts.app')
@extends('layouts.navbar')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <div class="row g-0 my-5">
        <div class="col-3 col-md-2 mx-5">
            <div class="container filter-products bg-light rounded p-3">
                <form action="{{route('menu')}}" method="GET">
                    <h1 class="colorOrange border-bottom pb-3"><i class="bi bi-filter colorOrange"></i> Filters</h1>
                    <div class="input-group rounded">
                        <input type="search" id="wordSearch" name="searchInput" class="form-control rounded"
                               placeholder="Search" aria-label="Search" aria-describedby="search-addon"/>
                        <span class="input-group-text border-0" id="search-addon">
                        <button type="submit" class="btn"><i class="bi bi-search"></i></button>
                    </span>
                    </div>
                    <h2 class="text-bold">Category</h2>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="filter" id="flexRadioDefault1" value="all"
                               checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            All
                        </label>
                    </div>
                    @foreach($categories as $category)
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="filter" id="flexRadioDefault1"
                                       value="{{$category['category']}}" {{ request('filter') == $category['category'] ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{$category['category']}}">
                                    {{$category['category']}} <span class="text-black-50">({{$category->products->count()}})</span>
                                </label>
                            </div>
                    @endforeach
                    <h2 class="text-bold">Price Range</h2>

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

                    <div class="range-slider w-100">
                        <div class="range-fill"></div>

                        <input
                            type="range"
                            class="min-price"
                            name="minPrice"
                            value="{{$prices[0]}}"
                            min="{{$prices[0]}}"
                            max="{{$prices[1]}}"
                        />
                        <input
                            type="range"
                            class="max-price"
                            name="maxPrice"
                            value="{{$prices[1]}}"
                            min="{{$prices[0]}}"
                            max="{{$prices[1]}}"
                        />
                    </div>
                    <button type="submit" class="btn btn-filter w-100 mt-3">Filter</button>
                </form>
            </div>
        </div>
        <div class="col-sm-6 col-md-8 mb-5">
            <div class="container bg-light rounded">
                <div class="row row-cols-1 row-cols-md-3 products">
                    @if(!$products->count())
                        <div class="container w-100 text-center">
                            <h2>We couldn’t find anything. Try to search something else.</h2>
                        </div>
                    @endif
                    @foreach($products as $product)
                        <div class="col my-3">
                            <div class="card h-100">
                                <img src="{{asset('storage/photos/' . $product['image']) }}"
                                     class="product-img card-img-top" alt="{{$product['title']}}">
                                <div class="card-body">
                                    <h3 class="card-title text-center">{{$product['title']}}</h3>
                                    <p class="card-text text-center">{{$product['price']}} $</p>
                                    <p class="card-text text-center"><a href="{{route('infoProduct', $product['id'])}}">{{ Str::limit($product['description'], 40) }}</a></p>
                                    <form action="{{route('addRemoveToCart', $product['id'])}}" method="post">
                                        @csrf
                                        @if(session('idProducts') && isset(session('idProducts')[$product['id']]) && session('idProducts')[$product['id']] > 0)
                                            <input type="submit" name="removeToCart" class="btn btn-danger w-100" value="Remove to cart">
                                        @else
                                            <input type="submit" name="addToCart" class="btn btn-success w-100" value="Add to cart">
                                        @endif

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
        let minValue = document.getElementById("min-value");
        let maxValue = document.getElementById("max-value");

        const rangeFill = document.querySelector(".range-fill");

        // Function to validate range and update the fill color on slider
        function validateRange() {
            let minPrice = parseInt(inputElements[10].value);
            let maxPrice = parseInt(inputElements[11].value);

            if (minPrice > maxPrice) {
                let tempValue = maxPrice;
                maxPrice = minPrice;
                minPrice = tempValue;
            }

            const minPercentage = ((minPrice - {{$prices[0]}}) / ({{$prices[1] - $prices[0]}})) * 100;
            const maxPercentage = ((maxPrice - {{$prices[0]}}) / ({{$prices[1] - $prices[0]}})) * 100;

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


