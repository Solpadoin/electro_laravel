<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'store'])->name('/');
Route::get('/checkout', [ProductController::class, 'checkOut'])->name('checkout');
Route::get('/index', [HomeController::class, 'main'])->name('index');
Route::get('/product/{id}', [ProductController::class, 'showProduct'])->name('product.show');
Route::get('/store', [StoreController::class, 'index'])->name('store');
Route::get('/store/search', [StoreController::class, 'search'])->name('store.search');

Route::group(['middleware' => 'auth'],
    function () {
        Route::group([
            'prefix' => '/order',
        ],
            function () {
                Route::post('/{id}/{count}', [ProductController::class, 'createOrderSingle'])->name('product.order');
                Route::post('/all', [ProductController::class, 'createOrderAll'])->name('product.order.all');
                Route::delete('/all/delete', [ProductController::class, 'deleteOrderAll'])->name('product.order.all.delete');
        });

        Route::group([
            'prefix' => '/cart',
        ],
            function () {
                Route::post('/{id}/{count}', [ProductController::class, 'addToCart'])->name('product.cart.add');
                Route::delete('/delete/{id}', [ProductController::class, 'deleteFromCart'])->name('product.cart.delete');

        });

        Route::group([
            'prefix' => '/wishlist',
        ],
            function () {
                Route::post('/{id}', [ProductController::class, 'wishlistAdd'])->name('product.wishlist.add');
                Route::delete('/delete/{id}', [ProductController::class, 'wishlistDelete'])->name('product.wishlist.delete');
        });

        Route::group([
            'prefix' => '/home',
        ],
            function () {
                Route::get('', [HomeController::class, 'index'])->name('home');
                Route::get('/wishlist', [ProductController::class, 'getWishlist'])->name('home.wishlist');
                Route::get('/cart', [ProductController::class, 'getCart'])->name('home.cart');
        });
    }
);

\Auth::routes();
