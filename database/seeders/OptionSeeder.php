<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->delete();

        for($i=1;$i<=100; $i++){
            for($j=1;$j<=4;$j++){
                DB::table('options')->insert([
                    'option' =>Str::random(15),
                    'answer' => 0,
                    'question_id' => $i,
               ]);
            }
            
        } 
    }
}
