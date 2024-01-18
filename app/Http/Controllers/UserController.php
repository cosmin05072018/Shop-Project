<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\Username;

class UserController extends Controller
{
    private $dd;

    public function index()
    {
        return view('index');
    }

    public function menu(Request $request)
    {
        $idCategory = Category::where('category', $request->filter)->first();
        $categories = Category::get();
        $products = Product::paginate(9);
        $minPriceDB = Product::min('price');
        $maxPriceDB = Product::max('price');
        $minPriceRequest = $request->minPrice;
        $maxPriceRequest = $request->maxPrice;

        $previousUrl = request()->header('referer');
        $filter= [];

        if ($previousUrl) {
            $urlParts = parse_url($previousUrl);

            if (isset($urlParts['query'])) {
                parse_str($urlParts['query'], $queryParameters);
                $filter = isset($queryParameters['filter']) ? $queryParameters['filter'] : null;
            }
        }

        if ($request->filter === 'all') {
            $products = $filter != $request->filter ? Product::paginate(9) : Product::whereBetween('price', [$minPriceRequest, $maxPriceRequest])->paginate(9);
        } elseif ($request->filter && $idCategory) {
            $products = $filter != $request->filter ? Product::where('category_id', $idCategory->id)->paginate(9) : Product::where('category_id', $idCategory->id)->whereBetween('price', [$minPriceRequest, $maxPriceRequest])->paginate(9);
            $minPriceDB = Product::where('category_id', $idCategory->id)->min('price');
            $maxPriceDB = Product::where('category_id', $idCategory->id)->max('price');
        }

        if ($request->searchInput) {
            $products = Product::where('title', 'like', '%' . $request->searchInput . '%')->paginate(9);
        }

        return view('menu', ['products' => $products, 'categories' => $categories, 'prices' => [$minPriceDB, $maxPriceDB]]);
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
        $idProductsSession = session('idProducts', []);
        $arrayWithIdProducts = session('arrayWithIdProducts', []);

        if ($request->addToCart && !in_array($idProduct, $arrayWithIdProducts)) {
            $idProductsSession[$idProduct] = 1;
            $arrayWithIdProducts[] = $idProduct;
            session(['idProducts' => $idProductsSession]);
        }

        if ($request->removeToCart) {
            if (isset($idProductsSession[$idProduct]) && $idProductsSession[$idProduct] > 0) {
                $idProductsSession[$idProduct]--;

                if ($idProductsSession[$idProduct] == 0) {
                    unset($idProductsSession[$idProduct]);
                }
                session(['idProducts' => $idProductsSession]);
            }
        }


        return redirect()->back();
    }

    public function cart()
    {
        $productsIds = array_keys(session('idProducts', []));
        $products = $productsIds ? Product::whereIn('id', $productsIds)->get() : [];

        $categoriesId=[];

        foreach ($products as $product){
            $categoriesId[] = $product->category_id;
        }

        $sessionKeys = array_keys(session('idProducts', []));

        $recommendedProducts = session('idProducts') ? Product::whereIn('category_id', $categoriesId)->whereNotIn('id', $sessionKeys)->take(5)->get() : [];

        return view('cart', ['products' => $products, 'recommendedProducts' => $recommendedProducts]);
    }

    public function infoProduct(Request $request){
        $product = Product::where('id', $request->id)->get();

        return view('infoProduct', ['infoProduct' => $product]);
    }

    public function updateQuantity(Request $request)
    {
        if ($request->ajax()) {

            session(['idProducts.' . $request->id => $request->quantity]);
            $priceProduct = Product::select('price')->where('id', $request->id)->get();
            return response()->json(['quantity' => $request->quantity, 'id' => $request->id, 'priceProduct' => $priceProduct]);
        }
    }

}

