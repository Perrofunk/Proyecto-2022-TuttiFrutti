<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Admin;
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
            User::factory(1)->hasAdmin(1, ['address_id' => Address::all()->random()->id])->create([
            'name'=>'Rodrigo',
            'surname'=>'Zanabria',
            'email'=>'gatopunk99@gmail.com',
            'phone'=>'3794-110162',
            //1 = admin, 2 = employee, 3 = client
            'user_type'=>'1',
            //Random:
            //'user_type'=>DB::select('select * from user_types where id = :id', ['id'=> 1])[0]->id,
            'password'=>bcrypt('97132468')
        ]);
        // User::factory(10)->create();
        User::factory(2)->hasAdmin(1)->create([
            'user_type'=>'1'
        ]);
        User::factory(5)->hasEmployee(1)->create([
            'user_type'=>'2'
        ]);
        User::factory(15)->hasClient()->create([
            'user_type'=>'3'
        ]);
        Address::factory(1)->create(['address'=>'305 Negro Arroyo Lane']);
        $admin = Admin::where('user_id', 1);
        $admin->update(['address_id' => Address::where('address', '305 Negro Arroyo Lane')->first()->id]);
    }
}
