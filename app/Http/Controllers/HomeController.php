<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    public function index()
    {
        $userSearchModel = UserSearch::where('user_id', '=', Auth::user()->id)->limit(1)->get();
        $recentProducts = collect(json_decode($userSearchModel[0]->last_search))->take(3);

        return $userSearchModel->isEmpty() ? view('home') : view('home_recent', [ 'recent' => $recentProducts ]);
    }
}
