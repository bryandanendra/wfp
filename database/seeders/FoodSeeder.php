<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i<3; $i++){
            for($j=0; $j<5; $j++){
                DB::table('foods')->insert([
                    'name' => 'Food ' .$i.$j,
                    'description' => 'Description of Food ' .$i.$j,
                    'price' => rand(10000, 25000),
                    'nutrition_facts' => 'Nutrition of Food ' .$i.$j,
                    'category_id' => $i,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
