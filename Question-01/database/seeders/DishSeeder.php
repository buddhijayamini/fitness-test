<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dish =  [
            [
             'type' => 'Main Dishes',
             'name' => 'Rice',
             'price' => 100,
            ],
            [
                'type' => 'Main Dishes',
                'name' => 'Rotty',
                'price' => 20,
            ],
            [
                'type' => 'Main Dishes',
                'name' => 'Noodles',
                'price' => 150,
            ],
            [
                'type' => 'Side Dishes',
                'name' => 'Wadai',
                'price' => 45,
            ],
            [
                'type' => 'Side Dishes',
                'name' => 'Dhal Curry',
                'price' => 75,
            ],
            [
                'type' => 'Side Dishes',
                'name' => 'Fish Curry',
                'price' => 120,
            ],
            [
                'type' => 'Dessert',
                'name' => 'Wattalapam',
                'price' => 40,
            ],
            [
                'type' => 'Dessert',
                'name' => 'Jelly',
                'price' => 20,
            ],
            [
                'type' => 'Dessert',
                'name' => 'Pudding',
                'price' => 25,
            ],
        ];

       Dish::insert($dish);
    }
}
