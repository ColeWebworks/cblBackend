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
            'name' => 'Digital',
            'order' => 1,
            'status' => 1
            ]);
        DB::table('categories')->insert([
            'name' => 'Arts',
            'order' => 2,
            'status' => 1
        ]);
        DB::table('categories')->insert([
            'name' => 'Crafts',
            'order' => 4,
            'status' => 0
        ]);
        DB::table('categories')->insert([
            'name' => 'Culinary',
            'order' => 3,
            'status' => 1
        ]);
        DB::table('categories')->insert([
            'name' => 'Marketing',
            'order' => 5,
            'status' => 1
        ]);
    }
}
