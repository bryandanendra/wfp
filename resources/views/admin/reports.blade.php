@extends('layouts.admin')

@section('title', 'Laporan Penjualan')
@section('reports-active', 'active')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">Penjualan Bulanan</h4>
                    <canvas id="monthlySalesChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">Kategori Penjualan</h4>
                    <canvas id="categorySalesChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Ringkasan Penjualan</h4>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Bulan</th>
                            <th>Total Penjualan</th>
                            <th>Jumlah Transaksi</th>
                            <th>Rata-rata per Transaksi</th>
                            <th>Produk Terlaris</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($salesSummary as $summary)
                        <tr>
                            <td>{{ date('F Y', mktime(0, 0, 0, $summary->month, 1, date('Y'))) }}</td>
                            <td>Rp {{ number_format($summary->total_sales, 0, ',', '.') }}</td>
                            <td>{{ $summary->transaction_count }}</td>
                            <td>Rp {{ number_format($summary->average_transaction, 0, ',', '.') }}</td>
                            <td>{{ $bestSellingProducts[$summary->month] ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data penjualan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data untuk grafik penjualan bulanan
    const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const monthlySalesData = Array(12).fill(0);
    
    @foreach ($monthlySales as $sales)
        monthlySalesData[{{ $sales->month - 1 }}] = {{ $sales->total_sales / 1000000 }}; // Convert to jutaan
    @endforeach
    
    var monthlySalesCtx = document.getElementById('monthlySalesChart').getContext('2d');
    var monthlySalesChart = new Chart(monthlySalesCtx, {
        type: 'bar',
        data: {
            labels: monthNames,
            datasets: [{
                label: 'Penjualan (dalam juta Rupiah)',
                data: monthlySalesData,
                backgroundColor: 'rgba(77, 85, 204, 0.7)',
                borderColor: 'rgba(77, 85, 204, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Data untuk grafik kategori penjualan
    const categoryLabels = [];
    const categorySalesData = [];
    
    @foreach ($categorySales as $catSales)
        categoryLabels.push('{{ $catSales->name }}');
        categorySalesData.push({{ $catSales->total_sales }});
    @endforeach
    
    // Fallback jika tidak ada data
    if (categoryLabels.length === 0) {
        categoryLabels.push('Tidak ada data');
        categorySalesData.push(1);
    }
    
    var categorySalesCtx = document.getElementById('categorySalesChart').getContext('2d');
    var categorySalesChart = new Chart(categorySalesCtx, {
        type: 'pie',
        data: {
            labels: categoryLabels,
            datasets: [{
                label: 'Persentase Penjualan',
                data: categorySalesData,
                backgroundColor: [
                    '#211C84',
                    '#4D55CC',
                    '#7A73D1',
                    '#B5A8D5',
                    '#a69bc2',
                    '#9892b9',
                    '#8785ba'
                ],
                borderColor: [
                    '#211C84',
                    '#4D55CC',
                    '#7A73D1',
                    '#B5A8D5',
                    '#a69bc2',
                    '#9892b9',
                    '#8785ba'
                ],
                borderWidth: 1
            }]
        }
    });
</script>
@endsection 