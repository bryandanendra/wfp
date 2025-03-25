<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Food;
use App\Models\Order;
use DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foods = Food::all();

        foreach ($foods as $food) {
            $arrFoods[$food->id] = $food->price;
        }
        
        $minFoodIndex=array_search(min($arrFoods), $arrFoods);
        $maxFoodIndex=array_search(max($arrFoods), $arrFoods);

        for ($i = 0; $i < 50; $i++) {
            $order = Order::create([
                'id' => $i,
                'tanggal' => '2025-'.rand(1, 12).'-'.rand(1, 28).':'.rand(0, 23).':'.rand(0, 59).':'.rand(0,59),
                'status' => rand(0,1), 
                'grand_total' => 0,
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ]);
            $grandTotal=0;
            $qty=rand(1, 10);
            for ($j = 0; $j < rand(1, 5); $j++) {
                $foodId=rand($minFoodIndex, $maxFoodIndex);
                $arrFoodOrders[$i]=[
                    'order_id' => $i,
                    'food_id' => $foodId,
                    'quantity' => $qty,
                    'harga_jual' => $arrFoods[$foodId],
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d')
                ];
                $order->foods()->attach($arrFoodOrders);
                $grandTotal+=$arrFoods[$foodId]*$qty/1000;   
            }
            DB::table('orders')->insert($arrFoodOrders);
            DB::table('food_orders')->insert($arrFoodOrders);
            
        }
    }
}
