<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        DB::table('categories')->insert([
            [ 
                'id' => 1,
              'name' =>'PHP Developer',
            ],
            [ 
                'id' => 2,
              'name' =>'Mern Developer',
            ],
            [ 
                'id' => 3,
              'name' =>'Java Developer',
            ],
          
       ]);
    }
}
