@extends('layouts.footer')
@extends('layouts.app')
@extends('layouts.navbar')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    @if($products)
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 p-0">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h5 class="mb-0">Cart - {{ count(session('idProducts', [])) }} items</h5>
                            </div>
                            <div class="card-body">
                                @foreach($products as $product)
                                    <div
                                        class="row mb-5 border-bottom pb-3 d-flex align-items-center justify-content-center">
                                        <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                            <div class="bg-image rounded">
                                                <img src="{{asset('storage/photos/' . $product['image']) }}"
                                                     class="w-100"
                                                     alt="{{$product['title']}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                            <h2><strong>{{$product['title']}}</strong></h2>
                                        </div>
                                        <div
                                            class="col-lg-4 col-md-6 mb-4 mb-lg-0 d-flex align-items-center justify-content-between flex-column">
                                            <div class="d-flex mb-4">
                                                <form id="updateQuantityForm" class="updateQuantityForm d-flex" method="POST" action="{{route('updateQuantity', $product['id'])}}">
                                                    @csrf
                                                <button type="submit" name="downQuanity" id="downQuanity" class="btn btn-light px-3 me-2"
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <div class="form-outline">
                                                    <input id="quantity{{$product['id']}}" min="1" name="quantity" value="{{session('idProducts')[$product['id']]}}" type="number"
                                                           class="quantity form-control bg-white text-center border-0" disabled/>
                                                </div>
                                                <button type="submit" name="upQuanity" id="upQuanity" class="btn btn-light px-3 ms-2"
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                                </form>
                                            </div>
                                            <p class="text-start text-md-center">
                                                <strong class="totalPriceProduct{{$product['id']}}">{{session('idProducts')[$product['id']] * $product['price'] }}.00 $</strong>
                                            </p>
                                            <form action="{{route('addRemoveToCart', $product['id'])}}" method="post">
                                                @csrf
                                                <input type="submit" name="removeToCart" class="btn btn-danger w-100"
                                                       value="Remove to cart">
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h5 class="mb-0">Order summary</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                        Cost products:
                                        <strong>
                                            @if($products)
                                                <div class="totalPrice"></div>
                                            @endif
                                        </strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        Cost delivery:

{{--                                        @if($products && $products->sum('price') < 100)--}}
{{--                                            <span class="text-bg-danger px-3">--}}
{{--                                        20 $--}}
{{--                                        </span>--}}
{{--                                        @else--}}
{{--                                            <span class="text-bg-success px-3">--}}
{{--                                        FREE--}}
{{--                                        </span>--}}
{{--                                        @endif--}}
                                        in progress...
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                        <div>
                                            <strong>Total amount</strong>
                                            <strong>
                                                <p class="mb-0">(including VAT)</p>
                                            </strong>
                                        </div>
                                        <span>
{{--                                        @if($products && $products->sum('price') < 100)--}}
{{--                                                <strong>{{$products->sum('price') + 20}} $</strong>--}}
{{--                                            @else--}}
{{--                                                <strong>{{$products->sum('price')}} $</strong>--}}
{{--                                            @endif--}}
                                    </span>
                                    </li>
                                </ul>
                                <button type="button" class="btn checkout w-100">
                                    Go to checkout
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($recommendedProducts->count())
                <div class="container rounded">
                    <h1 class="text-white">Recommanded Products</h1>
                    <div class="row">
                        @foreach($recommendedProducts as $recommendedProduct)
                            <div class="col-md-2 mb-4">
                                <div class="card h-100">
                                    <img src="{{asset('storage/photos/' . $recommendedProduct['image']) }}"
                                         class="card-img-top h-100" alt="Imagine card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $recommendedProduct['title'] }}</h5>
                                        <p class="card-text">{{ $recommendedProduct['price'] }}</p>
                                        <form action="{{route('addRemoveToCart', $recommendedProduct['id'])}}"
                                              method="post">
                                            @csrf
                                            <input type="submit" name="addToCart" class="btn btn-success w-100"
                                                   value="Add to cart">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
    @else
        <div class="container text-white my-5">
            <h1>Your shopping cart contains no products. To add products to your cart please <a
                    href="{{route('menu')}}">return to the store</a>.</h1>
        </div>
    @endif

    <script>
        $(document).ready(function(){
            $('.updateQuantityForm').submit(function (event) {
                event.preventDefault();

                let id = $(this).attr('action').split('/').pop();
                let url = $(this).attr("action");
                let identificatorValue = '#quantity' + id;
                let valueQuantity = $(identificatorValue).val();

                let formData = new FormData();
                formData.append('quantity', valueQuantity);
                formData.append('id', id);

                $.ajax({
                    url: url,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('.totalPrice').html(response.totalCartSum + ' $');
                        let totalPriceProduct = '.totalPriceProduct' + id;
                        $(totalPriceProduct).html(response.quantity * response.priceProduct[0].price + '.00 $')
                    },
                    error: function (xhr) {
                        console.log('Error: ' + xhr.responseText);
                    }
                });
            });

                $.ajax({
                    type: 'GET',
                    url: '{{ route("totalPriceCart") }}',
                    success: function(response) {
                        $('.totalPrice').html(response.totalCartSum + ' $');
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
        })
    </script>
@endsection
