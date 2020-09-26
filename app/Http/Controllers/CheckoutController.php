<?php

namespace App\Http\Controllers;

use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        $user = Auth::user();
        $user_order = UserOrder::where('user_id', '=', $user->id)->get();

        if ($user_order) {
            $total_price = 0;
            foreach ($user_order as $item){
                $total_price += $item->price;
            }

            return view('pages.checkout', [
                'userOrder' => $user_order,
                'totalPrice' => $total_price,
                'user' => $user
            ]);
        }

        return view('home');
    }
}
