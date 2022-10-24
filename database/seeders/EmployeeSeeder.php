<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('user_type', '=', '2')->get();
        foreach ($users as $user){
            Employee::factory(1)->create([
                'user_id' => $user->id
            ]);
        }
    }
}
