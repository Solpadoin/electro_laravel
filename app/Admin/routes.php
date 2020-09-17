<?php
// TO DO : REFACTOR THIS CODE

use App\Models\User; // ghetto lazy, fix this later

// Don't allow to use our admin panel if user not authorized
Route::group(['middleware' => 'auth'], function () {

    Route::get('', ['as' => 'admin.dashboard', function () {
        return AdminSection::view(view('pages.admin.dashboard'), 'Dashboard');
    }]);

    Route::get('information', ['as' => 'admin.information', function () {
        return AdminSection::view(view('pages.admin.information'), 'Server Information');
    }]);

    Route::get('product', ['as' => 'admin.product', function () {
        return AdminSection::view(view('pages.admin.product'), 'Products');
    }]);

    Route::get('orders', ['as' => 'admin.orders', function () {
        return AdminSection::view(view('pages.admin.orders'), 'User Orders');
    }]);

    Route::get('profile', ['as' => 'admin.profile', function () {
        return AdminSection::view(view('pages.admin.profile'), 'Profile - '.Auth::user()->name);
    }]);

    Route::get('exit', ['as' => 'admin.exit', function () {
        //return AdminSection::view(view('pages.admin.exit'), 'My profile');
        return redirect()->route('home'); // why not ? :D
    }]);

    Route::get('users', ['as' => 'admin.users', function () {
        // we should get admins for first...
        return AdminSection::view(view('pages.admin.users', [ 'userModel' => User::all()->sortByDesc('is_admin') ]), "All Users");
    }]);

    // TO DO : Do this in the Controller in future.
    Route::get('set_admin/{id}', ['as' => 'admin.set_admin', function ($id) {
        $authUser = Auth::user(); // get current user

        if (is_null($authUser) || (! $authUser->is_admin)) {
            return redirect()->route('index'); // we don't want to have exploits for non admin users. It's already done with middleware AdminAuth, but we do not wanna risk :D
        }

        /* Find user with current id */
        $user = User::all()->find($id);

        if (! $user->isAdmin()) {
            $user->giveAdmin();
        }
        else{
            $user->takeAdmin();
        }

        return redirect()->route('admin.users');
    }]);

    // TO DO : Do this in the Controller in future. There is in the world DRY methodology is crying right now...
    Route::get('set_manager/{id}', ['as' => 'admin.set_manager', function ($id) {
        $authUser = Auth::user(); // get current user

        if (is_null($authUser) || (! $authUser->is_admin)) {
            return redirect()->route('index'); // we don't want to have exploits for non admin users. It's already done with middleware AdminAuth, but we do not wanna risk :D
        }

        /* Find user with current id */
        $user = User::all()->find($id);

        if (! $user->hasRole(User::ROLE_MANAGER)) {
            $user->giveManager();
        }
        else{
            $user->takeManager();
        }

        return redirect()->route('admin.users');
    }]);

});
