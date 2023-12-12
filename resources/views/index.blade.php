@extends('layouts.app')
@extends('layouts.navbar')
@section('content')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <img class="heroImg img-fluid h-100" src="{{ asset('photos/backgroundIndex.jpg') }}" alt="">

    <div class="container-fluid text-center text-white d-flex align-items-center h-75 w-100 mt-5">
        <div class="row section-left mx-5">
            <div class="col align-self-start">
                <h1 class="title-section-center">Good Food Restaurant</h1>
                <p class="paragraph-section-center">Join us for a culinary escapade where variety meets excellence, and every bite tells a story. Our restaurant is not just a place to eat; it's a celebration of taste, an ode to culinary mastery that invites you to embark on a journey of gastronomic discovery.</p>
                <a class="nav-link mx-auto py-3 text-white bg-yellow rounded-pill w-25" href="{{route('menu')}}">Order Now</a>
            </div>
            <div class="col align-self-end"></div>
        </div>
    </div>
@if(!session('user'))
    <div class="modal fade" id="user" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Hello, dear!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Enter your name for a better experience, please!</h3>
                </div>
                <form method="POST" action="{{route('userDetails')}}">
                    @csrf
                    <div class="container">
                        <div class="form-group d-flex align-items-center justify-content-between">
                            <input type="text" name="username" class="form-control w-100 my-3" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your name">
                        </div>
                        @error('username')
                        <div class="mt-3 p-1 text-center alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-save-user w-100">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#user').modal('show');
        });
    </script>
@endif
@endsection
