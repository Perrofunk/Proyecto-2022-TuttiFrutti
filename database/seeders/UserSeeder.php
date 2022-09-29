<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'surname'=>'Zanabria',
            'email'=>'gatopunk99@gmail.com',
            //1 = admin, 2 = employee, 3 = client
            'user_type'=>'1',
            //Random:
            //'user_type'=>DB::select('select * from user_types where id = :id', ['id'=> 1])[0]->id,
            'password'=>bcrypt('97132468')
        ]);
        User::factory(10)->create();
    }
}
