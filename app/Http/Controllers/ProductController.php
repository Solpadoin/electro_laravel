<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\lessThanOrEqual;

class ProductController extends Controller
{
    public function __construct()
    {
    }

    public function index(){
        return view('pages.product');
    }

    private function wishlistManipulate($id, $delete = false){
        if (is_null($id)) {
            return redirect()->back();
        }

        $user = Auth::user();
        $product = Product::find($id);

        if ($delete)
            $user->unwish($product);
        else
            $user->wish($product);

        return redirect()->back();
    }

    public function wishlistAdd($id = null){
        return $this->wishlistManipulate($id);
    }

    public function wishlistDelete($id = null){
        return $this->wishlistManipulate($id, true);
    }

    public function getWishlist(){
        return view('pages.home_wishlist', [ 'wishlist' => Auth::user()->wishlist() ]);
    }

    public function getCart(){
        $wishlist = Auth::user()->wishlist('cart');
        $totalPrice = 0;

        foreach($wishlist as $item) {
            $totalPrice += $item->price;
        }

        return view('pages.home_cart', [ 'cart' => $wishlist, 'totalPrice' => $totalPrice ]);
    }

    public function showProduct($productId){
        $product = Product::find($productId);

        if (! is_null($product)) {
            return view('pages.product', [ 'product' => $product ]);
        }

        return redirect()->back();
    }

    private function writeToOrderModel(User $user, Product $product){
        $userOrder = new UserOrder();

        $userOrder->user_id = $user->id;
        $userOrder->product_id = $product->id;
        $userOrder->price = $product->price;
        $userOrder->count = 1;
        $userOrder->email = $user->email;
        $userOrder->title = $product->title;

        $userOrder->save();
    }

    private function createOrder($id, $count = 1){
        $user = Auth::user();
        $product = Product::find($id);

        if (is_null($product)){
            return redirect()->back();
        }

        $this->writeToOrderModel($user, $product);
        return redirect()->back();
    }

    public function deleteOrderAll(){
        UserOrder::where('user_id', '=', Auth::user()->id)->delete();
        return redirect()->back();
    }

    public function createOrderSingle($id, $count = 1){
        return $this->createOrder($id, $count);
    }

    public function createOrderAll(){
        $this->deleteOrderAll(); // clear all items stored in our DB before.

        $user = Auth::user();
        $wishlist = $user->wishlist('cart');

        foreach($wishlist as $item) {
            $product = Product::find($item->id);

            if (is_null($product)) {
                return redirect()->back();
            }
            $this->writeToOrderModel($user, $product);
        }

        return redirect()->back();
    }

    private function cartManipulate($id, $delete = null){
        if (is_null($id)) {
            return redirect()->back();
        }

        $user = Auth::user();
        $product = Product::find($id);
        if (is_null($delete) or $delete == false)
            $user->wish($product, 'cart');
        else
            $user->unwish($product, 'cart');

        return redirect()->back();
    }

    public function addToCart($id = null){
        return $this->cartManipulate($id);
    }

    public function deleteFromCart($id = null){
        return $this->cartManipulate($id, true);
    }

    public function checkOut()
    {
        $userOrder = UserOrder::where('user_id', '=', Auth::user()->id)->get();
        if (is_null($userOrder)) {
            return view('home');
        }

        $totalPrice = 0;
        foreach ($userOrder as $item){
            global $totalPrice;
            $totalPrice += $item->price;
        }

        return view('pages.checkout', [ 'userOrder' => $userOrder, 'totalPrice' => $totalPrice ]);
    }
}
