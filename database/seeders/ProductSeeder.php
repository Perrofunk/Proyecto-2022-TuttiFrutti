<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->create([
            'name'=>'Manzana',
            'category_id'=>'1',
            'price'=>'200'
        ]);
        Product::factory()->create(
            [
                'name'=>'Banana',
                'category_id'=>'1',
                'price'=>'120'
        ]);
        
        Product::factory()->create([
            'name'=>'Ciruela',
            'category_id'=>'1',
            'price'=>250
        ]);
        Product::factory()->create([
            'name'=>'Acelga',
            'category_id'=>'2',
            'price'=>150
        ]);
        Product::factory()->create([
            'name'=>'Lechuga',
            'category_id'=>'2',
            'price'=>150
        ]);
        Product::factory()->create([
            'name'=>'Chía',
            'category_id'=>'3',
            'price'=>150
        ]);
        Product::factory(15)->create();
        
    }
}
