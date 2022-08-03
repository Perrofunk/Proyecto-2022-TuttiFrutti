<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre' =>$this->faker->unique()->company(),
            'email'=>$this->faker->unique()->safeEmail(),
            'contacto'=>$this->faker->word(5),
            'direccion'=>$this->faker->address(),
            'telefono'=>$this->faker->phoneNumber()
        ];
    }
}
