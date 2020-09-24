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
        'smartphones',
        'cameras',
        'accessories'
    ];

    private $searchProducts;

    private function getTopSailingProducts () {
        return Product::all()->take(config('store.top_sailing_show_count'));
    }

    public function index(){
        $products = Product::paginate(config('store.default_pagination_count'));

        return view('pages.store', [
            'products' => $products,
            'sale' => $this->getTopSailingProducts()
        ]);
    }

    /* Show to user last GLOBAl search */
    public function lastSearch(){
        if ($this->searchProducts) {
            return $this->searchProducts;
        }

        return null;
    }

    public function searchBySearchBar(Request $request){
        $searchText = $request->input('search');
        $selectElement = $request->input('select');

        $this->searchProducts = Product::where('title', 'LIKE', '%'.$searchText.'%')->get();

        if (in_array($selectElement, $this->allCategories)) {
            $this->searchProducts = $this->searchProducts->where('category', '=', $selectElement);
        }

        //$this->searchProducts->paginate(config('store.default_pagination_count'));
        //$this->searchProducts->get();

        /* Just write to DB last user search ( show this in his home page later... ) */
        $searchModel = new UserSearch();
        $searchModel->user_id = Auth::user()->id;
        $searchModel->last_search = json_encode($this->searchProducts);
        $searchModel->save();

        return view('pages.store', [
            'products' => $this->searchProducts,
            'sale' => $this->getTopSailingProducts() ]);
    }

    public function searchFull(Request $request){
        $priceMin = $request->input('price-min');
        $priceMax = $request->input('price-max');

        $filterCategory = '';
        foreach ($this->allCategories as $category){
            if ($request->input($category)){
                $filterCategory .= $category." ";
            }
        }

        $filterArray = explode(" ", $filterCategory);
        foreach ($filterArray as $element){
            if (in_array($element, $this->allCategories)){
                // to do //
            }
        }

        $query = Product::where('price', '>', $priceMin)
            ->where('price', '<', $priceMax)
            ->where('category', 'LIKE', '%'.$filterCategory.'%')
            ->paginate(config('store.default_pagination_count'));

        return view('pages.store', [
            'products' => $query,
            'sale' => $this->getTopSailingProducts() ]);
    }
}
