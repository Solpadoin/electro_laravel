<?php

//namespace App\Http\Controllers;

Route::group(['middleware' => 'auth'], function () {
    Route::get('', ['as' => 'admin.dashboard', function () {
        return AdminSection::view(view('pages.admin.dashboard'), 'Dashboard');
    }]);

    Route::get('information', ['as' => 'admin.information', function () {
        return AdminSection::view(view('pages.admin.information'), 'Server Information');
    }]);

    Route::get('profile', ['as' => 'admin.profile', function () {
        return AdminSection::view(view('pages.admin.profile'), 'Profile');
    }]);

    Route::get('exit', ['as' => 'admin.exit', function () {
        return redirect()->route('home'); // why not ? :D
    }]);

    /*
        Route::get('', [
            'as' => 'admin.dashboard',
            'uses' => [AdminPanelController::class, 'dashboard']
        ]);

        Route::get('information', [
            'as' => 'admin.information',
            'uses' => [AdminPanelController::class, 'information']
        ]);

        Route::get('profile', [
            'as' => 'admin.profile',
            'uses' => [AdminPanelController::class, 'profile']
        ]);

        Route::get('exit', [
            'as' => 'admin.exit',
            'uses' => [AdminPanelController::class, 'exit']
        ]);
    */
});
