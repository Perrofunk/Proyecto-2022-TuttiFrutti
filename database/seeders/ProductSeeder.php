<?php

namespace Database\Seeders;

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
        Product::create([
            'name'=>'Manzana',
            'category_id'=>'1'
        ]);
        Product::create([
            'name'=>'Banana',
            'category_id'=>'1'
        ]);
        Product::create([
            'name'=>'Ciruela',
            'category_id'=>'1'
        ]);
        Product::create([
            'name'=>'Acelga',
            'category_id'=>'2'
        ]);
        Product::create([
            'name'=>'Lechuga',
            'category_id'=>'2'
        ]);
        Product::create([
            'name'=>'Chía',
            'category_id'=>'3'
        ]);
        Product::factory(5)->create();
    }
}
