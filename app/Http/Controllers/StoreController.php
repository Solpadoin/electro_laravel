<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\UserSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    private $allCategories = [
        'laptops',
        'smartphones'
    ];

    private $searchProducts;

    private function getTopSailingProducts () {
        return Product::all()->take(3);
    }

    public function index(){
        $products = Product::all();
        //$sale = $products->take(3);

        return view('pages.store', [
            'products' => $products,
            'sale' => $this->getTopSailingProducts()
        ]);
    }

    /* Show to user last GLOBAl search */
    public function lastSearch(){
        if (is_null($this->searchProducts)) {
            return null;
        }

        return $this->searchProducts;
    }

    public function search(Request $request){
        $searchText = $request->input('search');
        $selectElement = $request->input('select');

        $this->searchProducts = Product::where('title', 'LIKE', '%'.$searchText.'%')->get();

        if (in_array($selectElement, $this->allCategories)) {
            $this->searchProducts = $this->searchProducts->where('category', '=', $selectElement);
        }

        /* Just write to DB last user search ( show this in his home page later... ) */
        $searchModel = new UserSearch();
        $searchModel->user_id = Auth::user()->id;
        $searchModel->last_search = json_encode($this->searchProducts);
        $searchModel->save();

        return view('pages.store', [ 'products' => $this->searchProducts, 'sale' => $this->getTopSailingProducts() ]);
    }
}
