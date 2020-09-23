<?php

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

Route::get('/', function () {
    return redirect()->route('store');
})->name('/');

Route::get('/test', function () {
    if (env('APP_DEBUG') == true) {
        return view('pages.testpage');
    }
});

Route::get('/checkout', [App\Http\Controllers\ProductController::class, 'checkOut'])->name('checkout');

Route::get('/index', function () {
    return view('pages.index');
})->name('index');

Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'showProduct'])->name('product.show');

Route::get('/store', [App\Http\Controllers\StoreController::class, 'index'])->name('store');
Route::get('/store/search', [App\Http\Controllers\StoreController::class, 'search'])->name('store.search');

Route::group(['middleware' => 'auth'],
    function () {
        Route::group([
            'prefix' => '/order',
        ],
            function () {
                Route::post('/{id}/{count}', [App\Http\Controllers\ProductController::class, 'createOrderSingle'])->name('product.order');
                Route::post('/all', [App\Http\Controllers\ProductController::class, 'createOrderAll'])->name('product.order.all');
                Route::delete('/all/delete', [App\Http\Controllers\ProductController::class, 'deleteOrderAll'])->name('product.order.all.delete');
        });

        Route::group([
            'prefix' => '/cart',
        ],
            function () {
                Route::post('/{id}/{count}', [App\Http\Controllers\ProductController::class, 'addToCart'])->name('product.cart.add');
                Route::delete('/delete/{id}', [App\Http\Controllers\ProductController::class, 'deleteFromCart'])->name('product.cart.delete');

        });

        Route::group([
            'prefix' => '/wishlist',
        ],
            function () {
                Route::post('/{id}', [App\Http\Controllers\ProductController::class, 'wishlistAdd'])->name('product.wishlist.add');
                Route::delete('/delete/{id}', [App\Http\Controllers\ProductController::class, 'wishlistDelete'])->name('product.wishlist.delete');
        });

        Route::group([
            'prefix' => '/home',
        ],
            function () {
                Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
                Route::get('/wishlist', [App\Http\Controllers\ProductController::class, 'getWishlist'])->name('home.wishlist');
                Route::get('/cart', [App\Http\Controllers\ProductController::class, 'getCart'])->name('home.cart');
        });
    }
);

Auth::routes();
