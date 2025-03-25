<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            // Januari 2025
            [
                'tanggal' => '2025-01-05 12:30:00',
                'status' => 1, // 1 = Completed
                'grand_total' => 3000.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tanggal' => '2025-01-12 18:45:00',
                'status' => 1,
                'grand_total' => 6500.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tanggal' => '2025-01-25 20:15:00',
                'status' => 1,
                'grand_total' => 12000.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Februari 2025
            [
                'tanggal' => '2025-02-03 13:20:00',
                'status' => 1,
                'grand_total' => 4800.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tanggal' => '2025-02-14 19:30:00',
                'status' => 1,
                'grand_total' => 8500.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tanggal' => '2025-02-28 21:00:00',
                'status' => 1,
                'grand_total' => 3600.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Maret 2025
            [
                'tanggal' => '2025-03-10 14:45:00',
                'status' => 1,
                'grand_total' => 7200.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tanggal' => '2025-03-18 17:15:00',
                'status' => 1,
                'grand_total' => 9800.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tanggal' => '2025-03-25 20:30:00',
                'status' => 1,
                'grand_total' => 5500.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // April 2025 (untuk perbandingan)
            [
                'tanggal' => '2025-04-05 15:00:00',
                'status' => 1,
                'grand_total' => 6800.00,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        
        DB::table('orders')->insert($orders);
    }
}
