<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $migrations = [
            ['migration' => '2014_10_12_000000_create_users_table', 'batch' => 1],
            ['migration' => '2014_10_12_100000_create_password_reset_tokens_table', 'batch' => 1],
            ['migration' => '2019_08_19_000000_create_failed_jobs_table', 'batch' => 1],
            ['migration' => '2019_12_14_000001_create_personal_access_tokens_table', 'batch' => 1],
            ['migration' => '2025_03_06_073958_create_categories_table', 'batch' => 1],
            ['migration' => '2025_03_06_074234_create_foods_table', 'batch' => 1],
            ['migration' => '2025_03_20_080815_create_food_orders_table', 'batch' => 1],
            ['migration' => '2025_03_20_080919_create_orders_table', 'batch' => 1],
        ];

        foreach ($migrations as $migration) {
            DB::table('migrations')->insert($migration);
        }
    }
} 