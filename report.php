<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "===== 1. MAKANAN DENGAN KATEGORI BOOKS =====\n";
$results = DB::select('SELECT f.id, f.name AS nama_makanan, f.description, f.price, c.name AS kategori FROM foods f JOIN categories c ON f.category_id = c.id WHERE c.name = "Books"');
printResults($results);

echo "\n===== 2. MAKANAN DENGAN DESKRIPSI MENGANDUNG ANGKA 1 =====\n";
$results = DB::select('SELECT name AS nama_makanan, description AS deskripsi FROM foods WHERE description LIKE "%1%"');
printResults($results);

echo "\n===== 3. MAKANAN DENGAN HARGA DI BAWAH 2000 =====\n";
$results = DB::select('SELECT name AS nama_makanan, price AS harga FROM foods WHERE price < 2000');
printResults($results);

echo "\n===== 4. MAKANAN YANG PERNAH LAKU LEBIH DARI 2 PORSI DALAM SATU ORDER =====\n";
$results = DB::select('SELECT f.name AS nama_makanan, c.name AS kategori, fo.quantity AS jumlah FROM food_orders fo JOIN foods f ON fo.food_id = f.id JOIN categories c ON f.category_id = c.id WHERE fo.quantity > 2');
printResults($results);

echo "\n===== 5. TOTAL NOMINAL ORDER JANUARI-MARET 2025 =====\n";
$results = DB::select('SELECT SUM(grand_total) AS total_penjualan FROM orders WHERE tanggal BETWEEN "2025-01-01" AND "2025-03-31"');
printResults($results);

echo "\n===== 6. ORDER DENGAN GRAND TOTAL DI ATAS RATA-RATA =====\n";
$results = DB::select('SELECT id, tanggal, grand_total FROM orders WHERE grand_total > (SELECT AVG(grand_total) FROM orders)');
printResults($results);

echo "\n===== 7. KATEGORI MAKANAN PALING LAKU (3 BULAN TERAKHIR) =====\n";
$results = DB::select('SELECT c.name AS kategori, SUM(fo.quantity) AS total_terjual FROM food_orders fo JOIN foods f ON fo.food_id = f.id JOIN categories c ON f.category_id = c.id JOIN orders o ON fo.order_id = o.id WHERE o.tanggal >= DATE_SUB("2025-04-05", INTERVAL 3 MONTH) GROUP BY c.id, c.name ORDER BY total_terjual DESC LIMIT 1');
printResults($results);

echo "\n===== 8. KATEGORI, TANGGAL DIBUAT, DAN GRAND TOTAL PENJUALAN =====\n";
$results = DB::select('SELECT c.name AS kategori, c.created_at AS tanggal_dibuat, SUM(fo.quantity * fo.harga_jual) AS grand_total FROM categories c JOIN foods f ON c.id = f.category_id JOIN food_orders fo ON f.id = fo.food_id GROUP BY c.id, c.name, c.created_at');
printResults($results);

echo "\n===== 9. 5 MAKANAN TERMAHAL =====\n";
$results = DB::select('SELECT name AS nama_makanan, price AS harga FROM foods ORDER BY price DESC LIMIT 5');
printResults($results);

echo "\n===== 10. MAKANAN DENGAN NILAI PENJUALAN TERTINGGI =====\n";
$results = DB::select('SELECT c.name AS kategori, f.name AS nama_makanan, SUM(fo.quantity * fo.harga_jual) AS total_nilai FROM categories c JOIN foods f ON c.id = f.category_id JOIN food_orders fo ON f.id = fo.food_id GROUP BY c.id, c.name, f.id, f.name ORDER BY total_nilai DESC LIMIT 1');
printResults($results);

function printResults($results) {
    if (empty($results)) {
        echo "Tidak ada data ditemukan.\n";
        return;
    }
    
    // Get column headers
    $headers = array_keys((array) $results[0]);
    
    // Print headers
    foreach ($headers as $header) {
        echo str_pad($header, 20);
    }
    echo "\n";
    
    // Print separator
    echo str_repeat("=", count($headers) * 20) . "\n";
    
    // Print rows
    foreach ($results as $row) {
        $rowArray = (array) $row;
        foreach ($rowArray as $value) {
            echo str_pad((string) $value, 20);
        }
        echo "\n";
    }
} 