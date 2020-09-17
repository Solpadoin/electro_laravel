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
    return view('blank.blank');
})->name('/');

Route::get('/test', function () {
    if (env('APP_DEBUG') == true) {
        return view('pages.testpage');
    }
});

Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout');

Route::get('/index', function () {
    return view('pages.index');
})->name('index');

Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
Route::get('/store', [App\Http\Controllers\StoreController::class, 'index'])->name('store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/password/reset', function(){ return redirect('/password/reset'); })->name('password.reset_password');
