<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->truncate();

        User::create([
            'name' => 'One One',
            'email' => 'One@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'two two',
            'email' => 'two@gmail.com',
            'password' => Hash::make('password'),
        ]);

    }
}
