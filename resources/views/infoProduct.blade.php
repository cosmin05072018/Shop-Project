@extends('layouts.app')
@extends('layouts.navbar')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/infoProduct.css') }}">

    <div class="container mt-5">
        @foreach($infoProduct as $product)
            <div class="card">
                <div class="d-flex">
                    <img src="{{asset('storage/photos/' . $product['image']) }}" class="product-img card-img-top w-50" alt="{{$product['title']}}"/>
                    <div class="card-body d-flex align-items-center flex-column justify-content-around">
                        <h1 class="card-title text-center">{{$product['title']}}</h1>
                        <p class="card-text text-center">{{$product['price']}} $</p>
                        <p class="card-text text-center">{{$product['description']}}</p>
                        <form action="{{route('addRemoveToCart', $product['id'])}}" method="post" class="w-100">
                            @csrf
                           <div class="d-flex justify-content-around">
                               <a href="{{route('menu')}}" class="btn btn-danger w-25 text-white">Back to Menu</a>
                               @if(session('idProducts') && in_array($product['id'], session('idProducts')))
                                   <input type="submit" name="removeToCart" class="btn btn-danger w-25"
                                          value="Remove to cart">
                               @else
                                   <input type="submit" name="addToCart" class="btn btn-success w-25"
                                          value="Add to cart">
                               @endif
                           </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
        @endforeach
    </div>
@endsection
