<?php

namespace Database\Factories;

use App\Models\PaymentType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venta>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date'=>$this->faker->dateTime(),
            'total'=>$this->faker->randomNumber(3),
            'payment_type_id'=>PaymentType::all()->random()->id,
            'user_id'=>User::all()->random()->id
        ];
    }
}
