@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="{{ asset('css/loginCustom.css') }}">

<img src="{{ asset('photos/backgroundImage.jpg') }}" alt="">
    <div class="container min-vh-100 d-flex justify-content-center align-items-center text-white">
        <form action="{{ route('validateLogin') }}" method="POST"
            class="p-3 rounded form-group row col-4">
            @csrf
            <h1 class="text-center">Login</h1>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <div class="d-flex align-items-center">
                    <ion-icon name="mail" class="m-1"></ion-icon>
                    <input type="text"
                        class="form-control {{ old('email') && !$errors->has('email') ? 'is-valid' : ($errors->has('email') ? 'is-invalid' : '') }}"
                        name="email" value="{{ old('email') }}">
                </div>
                @error('email')
                    <div class="mt-1 w-100 p-1 text-center">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <div class="d-flex align-items-center">
                    <ion-icon name="eye-off" class="m-1" id="togglePassword" onclick="myFunction()"> </ion-icon>
                    <input type="password"
                        class="form-control {{ old('password') && !$errors->has('password') ? 'is-valid' : ($errors->has('password') ? 'is-invalid' : '') }}"
                        id="password" name="password">
                </div>
                @error('password')
                    <div class="mt-1 w-100 p-1 text-center">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>



    <script>
        function myFunction() {
            var password = document.getElementById("password");
            let eye = document.getElementById("togglePassword");
            if (password.type === "password") {
                password.type = "text";
                eye.setAttribute('name', 'eye');

            } else {
                password.type = "password";
                eye.setAttribute('name', 'eye-off');
            }
        }
    </script>

@endsection
