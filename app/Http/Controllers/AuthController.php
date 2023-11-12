<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAdminRequest;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function login()
    {
        if(!session('admin')){
            return view('login');
        }else{
            return view('dashboard');
        }
    }

    public function validateLogin(LoginAdminRequest $request)
    {
        return redirect()->route('dashboard')->with('checkAdmin', session(['admin' => true]));
    }
}
