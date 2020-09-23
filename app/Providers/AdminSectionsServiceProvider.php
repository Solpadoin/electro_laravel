<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Product;
use App\Models\UserOrder;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $sections = [
        User::class => 'App\Http\Sections\UsersSection',
        Product::class => 'App\Http\Sections\ProductsSection',
        UserOrder::class => 'App\Http\Sections\OrdersSection',
    ];

    /**Ы
     * Register sections.
     *
     * @param \SleepingOwl\Admin\Admin $admin
     * @return void
     */
    public function boot(\SleepingOwl\Admin\Admin $admin)
    {
    	//
        parent::boot($admin);
    }
}
