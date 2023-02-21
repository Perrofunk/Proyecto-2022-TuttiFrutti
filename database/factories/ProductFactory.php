<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        return [
            'name'=>$this->faker->unique()->word(10),
            'description'=>$this->faker->text(),
            'price'=>$this->faker->randomFloat(2, 0, 1000),
            'category_id'=>Category::all()->random()->id
        ];
    }
}
