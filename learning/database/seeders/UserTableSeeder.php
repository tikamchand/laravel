<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    DB::table('users')->insert( [
            'name' => 'Tikamchand',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
            // 'is_admin' => true,
        ]);
        $userCreate =  \App\Models\User::factory(20)->create();
    }
}
