<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_types')->delete();

            DB::table('question_types')->insert([
                [
                    'id' => 1,
                  'name' =>'mcq',
                ],
                [
                    'id' => 2,
                  'name' =>'code',
                ],

           ]);

}   }

