<?php

namespace App\Http\Controllers;

use App\Http\Requests\validateInputProduct;
use App\Models\Product;
use App\Models\Category;
use App\Models\AdminProfile;
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
        $userName = config('adminCredentials.username');

        $dataToDashboard = [
            'admin' => $userName
        ];

        $quotesAPI = [
            0 => [
                'author' => 'Thomas Keller',
                'quote' => 'A recipe has no soul. You as the cook must bring soul to the recipe.'
            ],
            1 => [
                'author' => 'Wolfgang Puck',
                'quote' => 'Cooking is like painting or writing a song. Just as there are only so many notes or colors, there are only so many flavors—it’s how you combine them that sets you apart.'
            ],
            2 => [
                'author' => 'Guy Fieri',
                'quote' => 'Cooking with kids is not just about ingredients, recipes, and cooking. It’s about harnessing imagination, empowerment, and creativity.'
            ],
            3 => [
                'author' => 'Craig Claiborne',
                'quote' => 'Cooking is at once child’s play and adult joy. And cooking done with care is an act of love.'
            ],
            4 => [
                'author' => 'Gordon Ramsay',
                'quote' => 'So when people ask me, ‘What do you think of Michelin?’ I don’t cook for guides. I cook for customers.'
            ],
            5 => [
                'author' => 'Judith B. Jones',
                'quote' => 'Cooking demands attention, patience, and above all, a respect for the gifts of the earth. It is a form of worship, a way of giving thanks.'
            ]
        ];
        $adminProfile = AdminProfile::all();
        return view('dashboard', ['data' => $dataToDashboard, 'quotesAPI' => $quotesAPI, 'adminProfile' => $adminProfile]);
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
        //products, categories
        $products = Product::paginate(10);
        $categories = Category::all();

        //min and max prices
        $minPriceProducts = Product::min('price');
        $maxPriceProducts = Product::max('price');

        //filter by category
        if ($request->category_filter) {

            //search id category
            $idCategory = Category::where('category', $request->category_filter)->first();

            $minPrice = $request->minValue;
            $maxPrice = $request->maxValue;

            if ($request->category_filter === 'all') {
                //if category is all, then return all products
                $products = Product::whereBetween('price', [$minPrice, $maxPrice])->paginate(10);
            } else {
                $products = Product::where('category_id', $idCategory->id)->get();
                $maxPriceProducts = $products->max('price');
                $minPriceProducts = $products->min('price');
                $products = Product::where('category_id', $idCategory->id)->whereBetween('price', [$minPrice, $maxPrice])->paginate(10);
            }
        }

        return view('viewProducts', ['products' => $products, 'totalProducts' => Product::count(), 'categories' => $categories, 'priceRange' => [$minPriceProducts, $maxPriceProducts]]);
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

        return redirect()->back()->with('statusDelete', 'The product has been deleted successfully!');
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

        return redirect()->route('viewProducts')->with('statusUpdate', 'The product has been updated successfully!');
    }

    public function adminProfile(){

        $adminProfile = AdminProfile::all();

        return view('adminProfile', ['adminProfile' => $adminProfile]);
    }
}


