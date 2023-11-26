<?php

namespace App\Http\Controllers;

use App\Http\Requests\validateInputProduct;
use App\Models\Product;
use App\Models\Category;
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
        $categories = Category::all();
        return view('addProduct', ['categories' => $categories]);
    }

    public function addProductDataBase(validateInputProduct $request)
    {
        $category = $request->category;
        $categoryId = Category::where('category', $category)->first()->id;
        $newImageName = time() . '-' . $request->title . '.' . $request->image->extension();
        $request->image->move(public_path('storage/photos'), $newImageName);
        $product = new Product;
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $categoryId,
            'image' => $newImageName
        ];
        $product->fill($data);
        $product->save();


        return redirect()->back();
    }

    public function viewProducts(Request $request)
    {
        $products = Product::paginate(10);

        $categories = Category::all();

        if ($request->has('date_filter')) {
            $products = Product::where('category', $request->date_filter)->paginate(10);
            if ($request->date_filter === 'all') {
                $products = Product::paginate(10);
            }
        }

        return view('viewProducts', ['products' => $products, 'categories' => $categories]);
    }

    public function detailsProduct(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);

        return view('detailsProduct', ['product' => $product]);
    }

    public function deleteProduct(Request $request)
    {
        Product::findOrFail($request->id)->destroy($request->id);

        return redirect()->back();
    }

    public function updateProductView(Request $request)
    {
        $productUpdate = Product::find($request->id);
        $categories = Category::all();

        return view('updateProductView', ['productUpdate' => $productUpdate, 'categories' => $categories]);
    }

    public function updateProduct(validateInputProduct $request)
    {
        $id = $request->id;

        $title = $request->title;
        $description = $request->description;
        $price = $request->price;
        $category = $request->category;
        $newImageName = time() . '-' . $request->title . '.' . $request->image->extension();
        $request->image->move(public_path('storage/photos'), $newImageName);
        $data = [
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'category' => $category,
            'image' => $newImageName
        ];
        $product = Product::findOrFail($id);
        $product->fill($data);
        $product->save();

        return redirect()->route('viewProducts');
    }
}
