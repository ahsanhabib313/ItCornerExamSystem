<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->delete();

        for($i=1;$i<=100; $i++){
            DB::table('questions')->insert([
                'id'               => $i,
                'question'         => Str::random(50),
                'category_id'      => random_int($min = 1, $max= 10),
                'question_type_id' => 1,
                'question_mark'    =>1
           ]);
        } 
    }
}
