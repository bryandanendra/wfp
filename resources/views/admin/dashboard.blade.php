@extends('layouts.admin')

@section('title', 'Dashboard')
@section('dashboard-active', 'active')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white mb-4" style="background-color: #211C84;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Pendapatan</h5>
                            <h3 class="mb-0">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                        </div>
                        <i class="fas fa-money-bill-wave fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('reports') }}" class="text-white stretched-link">Lihat Detail</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white mb-4" style="background-color: #4D55CC;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Pesanan</h5>
                            <h3 class="mb-0">{{ number_format($totalOrders, 0, ',', '.') }}</h3>
                        </div>
                        <i class="fas fa-shopping-cart fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('orders.index') }}" class="text-white stretched-link">Lihat Detail</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white mb-4" style="background-color: #7A73D1;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Menu</h5>
                            <h3 class="mb-0">{{ $totalMenu }}</h3>
                        </div>
                        <i class="fas fa-utensils fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('food.index') }}" class="text-white stretched-link">Lihat Detail</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white mb-4" style="background-color: #B5A8D5; color: #211C84;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Pelanggan</h5>
                            <h3 class="mb-0">{{ $totalCustomers }}</h3>
                        </div>
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between" style="border-top: 1px solid #9c91c2;">
                    <a href="{{ route('members.index') }}" class="stretched-link" style="color: #211C84;">Lihat Detail</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Pesanan per Hari
                </div>
                <div class="card-body">
                    <canvas id="orderChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    Metode Pembayaran
                </div>
                <div class="card-body">
                    <canvas id="paymentMethodChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Pesanan Terbaru
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead style="background-color: #B5A8D5; color: #211C84;">
                        <tr>
                            <th>Order ID</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentOrders as $order)
                        <tr>
                            <td>#{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $order->tanggal }}</td>
                            <td>{{ $order->member->name ?? 'Guest' }}</td>
                            <td>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                            <td>
                                @if ($order->status == 2)
                                    <span class="badge" style="background-color: #7A73D1;">Selesai</span>
                                @elseif ($order->status == 1)
                                    <span class="badge" style="background-color: #B5A8D5; color: #211C84;">Proses</span>
                                @else
                                    <span class="badge" style="background-color: #211C84;">Baru</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data pesanan terbaru</td>
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
    // Data dari controller
    const dayLabels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    const orderData = Array(7).fill(0);
    
    @foreach ($dailyOrders as $dayOrder)
        // DAYOFWEEK di MySQL: 1=Minggu, 2=Senin, dst
        // Kita sesuaikan untuk array JavaScript: 0=Senin, 6=Minggu
        orderData[{{ ($dayOrder->day - 2 + 7) % 7 }}] = {{ $dayOrder->order_count }};
    @endforeach
    
    // Chart untuk pesanan per hari
    var orderCtx = document.getElementById('orderChart').getContext('2d');
    var orderChart = new Chart(orderCtx, {
        type: 'line',
        data: {
            labels: dayLabels,
            datasets: [{
                label: 'Jumlah Pesanan',
                data: orderData,
                fill: false,
                borderColor: '#4D55CC',
                tension: 0.1
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

    // Data untuk metode pembayaran
    const paymentLabels = [];
    const paymentCounts = [];
    
    @foreach ($paymentMethods as $payment)
        paymentLabels.push('{{ $payment->payment_method }}');
        paymentCounts.push({{ $payment->count }});
    @endforeach
    
    // Chart untuk metode pembayaran
    var paymentCtx = document.getElementById('paymentMethodChart').getContext('2d');
    var paymentChart = new Chart(paymentCtx, {
        type: 'doughnut',
        data: {
            labels: paymentLabels.length > 0 ? paymentLabels : ['Cash', 'Debit', 'E-Wallet', 'Credit Card'],
            datasets: [{
                data: paymentCounts.length > 0 ? paymentCounts : [1, 1, 1, 1], // Default jika tidak ada data
                backgroundColor: [
                    '#211C84',
                    '#4D55CC',
                    '#7A73D1',
                    '#B5A8D5'
                ],
                borderWidth: 1
            }]
        }
    });
</script>
@endsection 