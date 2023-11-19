<?php

namespace App\Http\Controllers;

use App\Http\Requests\addProductDB;
use App\Models\Product;
use Illuminate\Http\Request;
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

    public function addProductView()
    {
        return view('addProduct');
    }

    public function addProductDataBase(addProductDB $request)
    {

        $newImageName = time() . '-' . $request->title . '.' . $request->image->extension();
        $request->image->move(public_path('storage/photos'), $newImageName);
        $product = new Product;
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'image' => $newImageName
        ];
        $product->fill($data);
        $product->save();


        return redirect()->back();
    }

    public function viewProducts(){
        $products = new Product;
        return view('viewProducts', ['products' => $products->all()]);
    }
}
