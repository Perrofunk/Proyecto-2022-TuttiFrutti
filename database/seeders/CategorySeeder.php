<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'=>'Fruta',
            'description'=>'Descripcion de Fruta para nuestra pagina web.'
        ]);
        Category::create([
            'name'=>'Verdura',
            'description'=>'Descripcion de Verdura para la pagina web.'
        ]);
        Category::create([
            'name'=>'Otro',
            'description'=>'Se describe la categoria Otro.'
        ]);
    }
}
