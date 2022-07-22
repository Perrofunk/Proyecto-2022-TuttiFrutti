<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Rodrigo',
            'email'=>'gatopunk99@gmail.com',
            'password'=>bcrypt('97132468')
        ]);
        User::factory(10)->create();
    }
}
