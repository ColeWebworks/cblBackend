<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Arts and Creative ',
            'order' => 1,
            'status' => 1
            ]);
        DB::table('categories')->insert([
            'name' => 'Construction',
            'order' => 2,
            'status' => 1
        ]);
        DB::table('categories')->insert([
            'name' => 'Digital',
            'order' => 3,
            'status' => 1
        ]);
        DB::table('categories')->insert([
            'name' => 'Food and Hospitality',
            'order' => 4,
            'status' => 1
        ]);
        DB::table('categories')->insert([
            'name' => 'Health and Social Care',
            'order' => 5,
            'status' => 1
        ]);
        DB::table('categories')->insert([
          'name' => 'Health and Social Care',
          'order' => 6,
          'status' => 1
        ]);
        DB::table('categories')->insert([
          'name' => 'Horticulture, Leisure and Tourism',
          'order' => 7,
          'status' => 1
        ]);
        DB::table('categories')->insert([
          'name' => 'Marine Engineering',
          'order' => 8,
          'status' => 1
        ]);
    }
}
