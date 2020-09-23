<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('pages.store', [ 'products' => $products ]);
    }

    public function search(Request $request){
        $searchText = $request->input('search');
        $products = Product::where('title', 'LIKE', '%'.$searchText.'%')->get();

        return view('pages.store', [ 'products' => $products ]);
    }
}
