<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product([
            'category_id'=>1,
            'imagePath' => 'image2.jpg',
            'title' => 'Harry Potter',
            'description' => 'Super cool - at least as a child.',
            'price' => 10
        ]);
        $product->save();

        $product = new \App\Product([
            'category_id'=>1,
            'imagePath' => 'image3.jpg',
            'title' => 'A Song of Ice and Fire - A Storm of Swords',
            'description' => 'No one is going to survive!',
            'price' => 10
        ]);
        $product->save();

        $product = new \App\Product([
            'category_id'=>1,
            'imagePath' => 'image4.jpg',
            'title' => 'Lord of the Rings',
            'description' => 'I found the movies to be better ...',
            'price' => 20
        ]);
        $product->save();

        $product = new \App\Product([
            'category_id'=>2,
            'imagePath' => 'image5.jpg',
            'title' => 'A Song of Ice and Fire - Game of Thrones',
            'description' => 'No one is going to survive!',
            'price' => 20
        ]);
        $product->save();

        $product = new \App\Product([
            'category_id'=>2,
            'imagePath' => 'image6.jpg',
            'title' => 'A Song of Ice and Fire - A Feast for Crows',
            'description' => 'Still, no one is going to survive!',
            'price' => 20
        ]);
        $product->save();
    }
}
