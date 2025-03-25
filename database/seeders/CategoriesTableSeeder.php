<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Books'],
            ['name' => 'Appetizer'],
            ['name' => 'Main Course'],
            ['name' => 'Dessert'],
            ['name' => 'Beverage'],
        ];

        DB::table('categories')->insert($categories);
    }
}
