<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('user_type', '=', '3')->get();
        foreach ($users as $user) {
            Client::factory(1)->create([
                'user_id' => $user->id
            ]);
        }
    }
}
