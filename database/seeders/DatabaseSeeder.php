<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\UserCurrency;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Product::factory(9)->create();
        UserCurrency::factory(1)->create();
    }
}
