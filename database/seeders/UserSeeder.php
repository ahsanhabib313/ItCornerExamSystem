<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        for($i=1; $i<=100;$i++){
            DB::table('users')->insert([
                 'id' => $i,
                 'first_name' => Str::random(15),
                 'email' =>Str::random(10).'@gmail.com',
                 'password'=> Hash::make('password'),
                 'question_limit_id' => random_int($min= 1, $max= 20),
            ]);
        }
        
    }
}
