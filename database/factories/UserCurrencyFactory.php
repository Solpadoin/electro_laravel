<?php

namespace Database\Factories;

use App\Models\UserCurrency;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserCurrencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserCurrency::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(11, 11),
            'currency' => $this->faker->randomNumber(),
        ];
    }
}
