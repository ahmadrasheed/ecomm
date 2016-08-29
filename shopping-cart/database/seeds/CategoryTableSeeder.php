<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new \App\Category([
            'name' => 'laptops',
            'description' => 'contains many types of laptops and PCs',

        ]);
        $category->save();


        $category = new \App\Category([
            'name' => 'Cameras',
            'description' => 'contains many types of moderns cameras',

        ]);
        $category->save();


        $category = new \App\Category([
            'name' => 'Servers',
            'description' => 'contains many types of moderns Servers used to managing Networks',
        ]);
        $category->save();
    }
}
