<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\Username;

class UserController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function menu(Request $request)
    {
        $idCategory = Category::where('category', $request->filter)->first();
        $categories = Category::get();

        if (session('idProducts')) {
            $products = Product::whereNotIn('id', session('idProducts'))->paginate(9);
        } else {
            $products = Product::paginate(9);
        }

        if ($request->filter === 'all' && session('idProducts')) {
            $products = Product::whereNotIn('id', session('idProducts'))->paginate(9);
        } elseif ($request->filter && $idCategory) {
            $products = session('idProducts') ? Product::where('category_id', $idCategory->id)->whereNotIn('id', session('idProducts'))->paginate(9) : Product::where('category_id', $idCategory->id)->paginate(9);
        }

        if ($request->searchInput) {
            $products = Product::where('title', 'like', '%' . $request->searchInput . '%')->paginate(9);
        }

        return view('menu', ['products' => $products, 'categories' => $categories]);
    }

    public function userDetails(Username $request)
    {
        $user = $request->username;
        session(['user' => $user]);
        return redirect()->back();
    }

    public function addToCart(Request $request)
    {
        $idProduct = $request->id;

        $idProducts = session('idProducts', []);

        if (!in_array($idProduct, $idProducts)) {
            $idProducts[] = $idProduct;
            session(['idProducts' => $idProducts]);
        }

        return redirect()->back();
    }

    public function cart()
    {
        $products = session('idProducts') ? Product::where('id', session('idProducts'))->get() : [];

        return view('cart', ['products' => $products]);
    }

}

