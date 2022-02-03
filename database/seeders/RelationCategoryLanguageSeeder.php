<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class RelationCategoryLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('relation_category_languages')->delete();

        for($i=1;$i<=10; $i++){
            for($j=1;$j<=5;$j++){
                DB::table('relation_category_languages')->insert([
                    'category_id'=> $i,
                    'language_id'   => random_int($min = 1, $max = 10),
               ]);
            }
           
        } 

    }
}
