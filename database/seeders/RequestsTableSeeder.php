<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Request;
use App\User;

class RequestsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('requests')->truncate(); 

        $users = User::all();

        foreach ($users as $user) {
            Request::create([
                'topic' => 'third third',
                'user_id' => $user->id,
                'message' => '111111111222222121' . $user->name,
                'status' => 'new',
            ]);
			
            Request::create([
                'topic' => 'four four',
                'user_id' => $user->id,
                'message' => '22222222211111' . $user->name,
                'status' => 'new',
            ]);

        }
    }
}
