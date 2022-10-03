<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(
             [
            'product_name' => 'sports shoe',
            'product_description' => "The shoes are designed to protect the wearer's foot from the hard, sharp rocks that make up the trail. The shoes have a thick, hard plastic covering that makes them extra durable.",
            'product_price' => '599',
            'product_quantity' => '12',
            'image' => '/img/shoe1.jpg'
             ],
           
        );   
    DB::table('products')->insert(
        [
            'product_name' => 'nike para',
            'product_description' => "It has a good grip on the bottom and it has good traction. It has a thick sole and it is not too tall. It is a great pair of shoes for any formal occasion, but it is also perfect for day-to-day use.",
            'product_price' => '799',
            'product_quantity' => '17',
            'image' => '/img/shoe2.jpg'
        ],
    );
    DB::table('products')->insert(
        [
         'product_name' => 'formal black',
         'product_description' => 'A white, pointy, clunky, sturdy shoe with a red strip on the side of the heel.',
         'product_price' => '899',
         'product_quantity' => '2',
         'image' => '/img/shoe3.jpg'
         ],
    );
    DB::table('products')->insert(
        [
         'product_name' => 'multi-color sneaker',
         'product_description' => 'It is a great pair of shoes for any formal occasion, but it is also perfect for day-to-day use.',
         'product_price' => '399',
         'product_quantity' => '20',
         'image' => '/img/shoe4.jpg'
         ],
    );
    DB::table('products')->insert(
         
       [
       'product_name' => 'pizza shoe',
       'product_description' => "It's a pizza shoe designed by sanjeev kapoor you wear it and eat it at same time",
       'product_price' => '999',
       'product_quantity' => '5',
       'image' => '/img/shoe5.jpg'
       ],
    );
    }
}
