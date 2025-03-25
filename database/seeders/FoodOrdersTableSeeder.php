<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foodOrders = [
            // Order 1
            [
                'order_id' => 1,
                'food_id' => 1, // Book Burger
                'quantity' => 1,
                'harga_jual' => 1500.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 1,
                'food_id' => 10, // Fruity Juice
                'quantity' => 1,
                'harga_jual' => 1500.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Order 2
            [
                'order_id' => 2,
                'food_id' => 2, // Novel Noodles
                'quantity' => 1,
                'harga_jual' => 2500.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 2,
                'food_id' => 4, // Garlic Bread
                'quantity' => 2,
                'harga_jual' => 2000.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Order 3
            [
                'order_id' => 3,
                'food_id' => 6, // Steak Supreme
                'quantity' => 2,
                'harga_jual' => 6000.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 3,
                'food_id' => 3, // Dictionary Donut
                'quantity' => 5,
                'harga_jual' => 6000.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Order 4
            [
                'order_id' => 4,
                'food_id' => 7, // Grilled Salmon
                'quantity' => 1,
                'harga_jual' => 4800.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Order 5
            [
                'order_id' => 5,
                'food_id' => 6, // Steak Supreme
                'quantity' => 1,
                'harga_jual' => 5500.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 5,
                'food_id' => 8, // Chocolate Cake
                'quantity' => 1,
                'harga_jual' => 2000.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 5,
                'food_id' => 11, // Coffee Premium
                'quantity' => 1,
                'harga_jual' => 1000.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Order 6
            [
                'order_id' => 6,
                'food_id' => 9, // Ice Cream Delight
                'quantity' => 1,
                'harga_jual' => 1500.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 6,
                'food_id' => 5, // Spring Rolls
                'quantity' => 1,
                'harga_jual' => 1600.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 6,
                'food_id' => 1, // Book Burger
                'quantity' => 1,
                'harga_jual' => 500.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Order 7
            [
                'order_id' => 7,
                'food_id' => 2, // Novel Noodles
                'quantity' => 2,
                'harga_jual' => 5000.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 7,
                'food_id' => 11, // Coffee Premium
                'quantity' => 1,
                'harga_jual' => 1200.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 7,
                'food_id' => 9, // Ice Cream Delight
                'quantity' => 1,
                'harga_jual' => 1000.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Order 8
            [
                'order_id' => 8,
                'food_id' => 6, // Steak Supreme
                'quantity' => 1,
                'harga_jual' => 5500.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 8,
                'food_id' => 7, // Grilled Salmon
                'quantity' => 1,
                'harga_jual' => 4300.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Order 9
            [
                'order_id' => 9,
                'food_id' => 3, // Dictionary Donut
                'quantity' => 3,
                'harga_jual' => 3600.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 9,
                'food_id' => 10, // Fruity Juice
                'quantity' => 1,
                'harga_jual' => 1200.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 9,
                'food_id' => 11, // Coffee Premium
                'quantity' => 1,
                'harga_jual' => 700.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Order 10
            [
                'order_id' => 10,
                'food_id' => 6, // Steak Supreme
                'quantity' => 1,
                'harga_jual' => 5500.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 10,
                'food_id' => 10, // Fruity Juice
                'quantity' => 1,
                'harga_jual' => 1300.00,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        
        DB::table('food_orders')->insert($foodOrders);
    }
}
