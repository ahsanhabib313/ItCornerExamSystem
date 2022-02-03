<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->delete();

        for($i=1; $i<=10;$i++){
            DB::table('languages')->insert([
                 'id' => $i,
                 'name' => Str::random(10),
                 
            ]);
        }
    }
}
