<?php

namespace Database\Factories;

use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'street' => $this->faker->streetName(),
            'address'=> $this->faker->streetAddress(),
            'department' => $this->faker->buildingNumber(),
            'zone_id' => Zone::first()->id,
            'details' => $this->faker->realText()
        ];
    }
}
