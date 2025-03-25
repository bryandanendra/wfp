<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foods = [
            // Books (Category 1)
            [
                'name' => 'Book Burger',
                'description' => 'Burger berbentuk buku dengan page 1',
                'nutritions_fact' => 'Protein: 25g, Carbs: 30g, Fat: 15g',
                'price' => 1500.00,
                'category_id' => 1
            ],
            [
                'name' => 'Novel Noodles',
                'description' => 'Mie spesial dengan stories edition',
                'nutritions_fact' => 'Protein: 10g, Carbs: 50g, Fat: 8g',
                'price' => 2500.00,
                'category_id' => 1
            ],
            [
                'name' => 'Dictionary Donut',
                'description' => 'Donat dengan kosakata di setiap gigitannya',
                'nutritions_fact' => 'Protein: 5g, Carbs: 40g, Fat: 20g',
                'price' => 1200.00,
                'category_id' => 1
            ],
            
            // Appetizer (Category 2)
            [
                'name' => 'Garlic Bread',
                'description' => 'Roti dengan bumbu bawang putih spesial',
                'nutritions_fact' => 'Protein: 5g, Carbs: 30g, Fat: 10g',
                'price' => 1800.00,
                'category_id' => 2
            ],
            [
                'name' => 'Spring Rolls',
                'description' => 'Rollade dengan isian sayuran segar',
                'nutritions_fact' => 'Protein: 8g, Carbs: 25g, Fat: 12g',
                'price' => 1600.00,
                'category_id' => 2
            ],
            
            // Main Course (Category 3)
            [
                'name' => 'Steak Supreme',
                'description' => 'Steak daging premium kelas 1',
                'nutritions_fact' => 'Protein: 35g, Carbs: 10g, Fat: 25g',
                'price' => 5500.00,
                'category_id' => 3
            ],
            [
                'name' => 'Grilled Salmon',
                'description' => 'Salmon panggang dengan saus lemon',
                'nutritions_fact' => 'Protein: 30g, Carbs: 5g, Fat: 18g',
                'price' => 4800.00,
                'category_id' => 3
            ],
            
            // Dessert (Category 4)
            [
                'name' => 'Chocolate Cake',
                'description' => 'Kue coklat dengan lelehan coklat premium',
                'nutritions_fact' => 'Protein: 6g, Carbs: 45g, Fat: 22g',
                'price' => 2200.00,
                'category_id' => 4
            ],
            [
                'name' => 'Ice Cream Delight',
                'description' => 'Es krim dengan 3 rasa berbeda',
                'nutritions_fact' => 'Protein: 4g, Carbs: 35g, Fat: 15g',
                'price' => 1500.00,
                'category_id' => 4
            ],
            
            // Beverage (Category 5)
            [
                'name' => 'Fruity Juice',
                'description' => 'Jus buah segar dengan tambahan vitamin',
                'nutritions_fact' => 'Protein: 1g, Carbs: 20g, Fat: 0g',
                'price' => 1200.00,
                'category_id' => 5
            ],
            [
                'name' => 'Coffee Premium',
                'description' => 'Kopi premium dari biji pilihan',
                'nutritions_fact' => 'Protein: 0g, Carbs: 5g, Fat: 0g',
                'price' => 1800.00,
                'category_id' => 5
            ]
        ];
        
        DB::table('foods')->insert($foods);
    }
}
