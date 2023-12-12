@extends('layouts.app')
@extends('layouts.navbar')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    @foreach($products as $product)
        {{$product}}
    @endforeach
@endsection
