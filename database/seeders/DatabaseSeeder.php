<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Post;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        Storage::makeDirectory('public/posts');
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        Tag::factory(8)->create();
        $this->call(PostSeeder::class);

        $suppliers = Supplier::factory(3)->create();
        foreach ($suppliers as $supplier) {
            Compra::factory(3)->create([
                'supplier_id'=>$supplier->id
            ]);
        }

        $compras=Compra::all();
        foreach ($compras as $compra){
            DetalleCompra::factory(1)->create([
                'compra_id'=>$compra->id,
                'product_id'=>Product::all()->random(3)->first()->id
            ]);
            DetalleCompra::factory(1)->create([
                'compra_id'=>$compra->id,
                'product_id'=>Product::all()->random(3)->first()->id
            ]);
            DetalleCompra::factory(1)->create([
                'compra_id'=>$compra->id,
                'product_id'=>Product::all()->random(3)->first()->id
            ]);
        }
        // Compra::factory(6)->create([
        //     'supplier_id'=>rand(1, 3)
        // ]);
        
    }
}
