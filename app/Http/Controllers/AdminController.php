<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Routing\Controller;

class AdminController extends Controller
{


    public function logout()
    {
        session()->forget('admin');
        return redirect()->route('login');
    }

    public function dashboard()
    {
        $products = Product::all();

        $userName = config('adminCredentials.username');

        $dataToDashboard = [
            'admin' => $userName,
            'products' => $products
        ];

        return view('dashboard', ['data' => $dataToDashboard]);
    }

    public function addProduct(){
        return view('addProduct');
    }
}
