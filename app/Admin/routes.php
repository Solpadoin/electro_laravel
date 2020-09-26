<?php
Route::group(['middleware' => 'auth'], function () {

    Route::get('', ['as' => 'admin.dashboard', function () {
        return AdminSection::view(view('pages.admin.dashboard'), 'Dashboard');
    }]);

    Route::get('information', ['as' => 'admin.information', function () {
        return AdminSection::view(view('pages.admin.information'), 'Server Information');
    }]);

    Route::get('orders', ['as' => 'admin.orders', function () {
        return AdminSection::view(view('pages.admin.orders'), 'User Orders');
    }]);

    Route::get('profile', ['as' => 'admin.profile', function () {
        return AdminSection::view(view('pages.admin.profile'), 'Profile');
    }]);

    Route::get('exit', ['as' => 'admin.exit', function () {
        return redirect()->route('home'); // why not ? :D
    }]);
});
