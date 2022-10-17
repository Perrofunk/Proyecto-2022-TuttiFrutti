<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Employee;
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
            'userable_id'=>Admin::create()->id,
            'userable_type'=>Admin::class,
            //Random:
            //'user_type'=>DB::select('select * from user_types where id = :id', ['id'=> 1])[0]->id,
            'password'=>bcrypt('97132468')
        ]);
            User::create([
            'name'=>'Pedro',
            'surname'=>'Echeverria',
            'email'=>'test@nonexistent.com',
            
            'userable_id'=>Employee::factory()->create()->id,
            'userable_type'=>Employee::class,
            
            'password'=>bcrypt('97132468')
        ]);
            User::create([
            'name'=>'Pepe',
            'surname'=>'Escobar',
            'email'=>'testeando@nonexistent.com',
            
            'userable_id'=>Employee::factory()->create()->id,
            'userable_type'=>Employee::class,
            
            'password'=>bcrypt('97132468')
        ]);
            User::create([
            'name'=>'Gabriel',
            'surname'=>'Gomez',
            'email'=>'test2@nonexistent.com',
            'userable_id'=>Client::factory()->create()->id,
            'userable_type'=>Client::class,
            
            'password'=>bcrypt('97132468')
        ]);
            User::create([
            'name'=>'Gallo',
            'surname'=>'Gonzalez',
            'email'=>'test4@nonexistent.com',
            'userable_id'=>Client::factory()->create()->id,
            'userable_type'=>Client::class,
            
            'password'=>bcrypt('97132468')
        ]);
            Admin::create([
        ])->users()->create([
            'name'=>'asd',
            'surname'=>'asd',
            'email'=>'asd@nonexistent.com',
            'password'=>bcrypt('97132468')
        ]);
            
        //  User::factory(10)->create();
    }
}
