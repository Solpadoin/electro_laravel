<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\UserSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    private $all_categories = [
        'laptops',
        'smartphones',
        'cameras',
        'accessories'
    ];

    private $search_products;

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
        if ($this->search_products) {
            return $this->search_products;
        }

        return null;
    }

    public function searchBySearchBar(Request $request){
        $search_text = $request->input('search');
        $select_element = $request->input('select');

        $this->search_products = Product::where('title', 'LIKE', '%'.$search_text.'%')->get();

        if (in_array($select_element, $this->all_categories)) {
            $this->search_products = $this->search_products->where('category', '=', $select_element);
        }

        /* Just write to DB last user search ( show this in his home page later... ) */
        $search_model = new UserSearch();
        $search_model->user_id = Auth::user()->id;
        $search_model->last_search = json_encode($this->search_products);
        $search_model->save();

        return view('pages.store', [
            'products' => $this->search_products,
            'sale' => $this->getTopSailingProducts() ]);
    }

    public function searchFull(Request $request){
        $price_min = $request->input('price-min');
        $price_max = $request->input('price-max');

        $filter_category = '';
        foreach ($this->all_categories as $category){
            if ($request->input($category)){
                $filter_category .= $category;
            }
        }

        /*
        $query = Product::where('price', '>', $price_min)
            ->where('price', '<', $priceMax)
            ->where('category', 'LIKE', '%'.$filter_category.'%')
            ->paginate(config('store.default_pagination_count'));
        */

        $query = Product::where('price', '>', $price_min)
            ->where('price', '<', $price_max);

        if ($filter_category){
            $filter_array = explode(" ", $filter_category);
            foreach ($filter_array as $element){
                if (in_array($element, $this->all_categories)){
                    $query->where('category', 'LIKE', '%'.$element.'%');
                }
            }
        }

        $query = $query->paginate(config('store.default_pagination_count'));

        return view('pages.store', [
            'products' => $query,
            'sale' => $this->getTopSailingProducts() ]);
    }
}
