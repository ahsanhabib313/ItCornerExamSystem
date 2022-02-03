<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionLimitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_limits')->delete();

        for($i=1; $i<=20;$i++){
            DB::table('question_limits')->insert([
                 'id' => $i,
                 'limit' => random_int($min = 20, $max= 30),
                 
            ]);
        }
    }
}
