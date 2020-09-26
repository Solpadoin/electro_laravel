<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserCurrency;
use App\Models\UserSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        /* A crutch: we should create new data with related tables */
        if (!Auth::user()->currency) {
            UserCurrency::init(Auth::user()->id, 0);
            return redirect()->back();
        }

        $query = UserSearch::where('user_id', '=', Auth::user()->id)->latest()->first();

        if ($query) {
            $recent_products = collect($query)->take(config('store.recent_products_count'));
            $products = collect(json_decode($recent_products['last_search']))->take(config('store.recent_products_count'));

            $query->delete(); // clear our information when we receive search info
            return view('home_recent', [ 'recent' => $products ]);
        }

        return view('home');
    }

    public function store(){
        return redirect()->route('store');
    }

    public function main(){
        return view('pages.index');
    }
}
