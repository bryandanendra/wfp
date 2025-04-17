@extends('layouts.adminlte')

@section('title', 'Dashboard')
@section('dashboard-active', 'active')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Total Pendapatan</h5>
                        <h3 class="mb-0">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                    </div>
                    <i class="bi bi-cash-coin fs-1"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('reports') }}" class="text-primary stretched-link">Lihat Detail</a>
                <i class="bi bi-chevron-right"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Total Pesanan</h5>
                        <h3 class="mb-0">{{ number_format($totalOrders, 0, ',', '.') }}</h3>
                    </div>
                    <i class="bi bi-cart fs-1"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('orders.index') }}" class="text-info stretched-link">Lihat Detail</a>
                <i class="bi bi-chevron-right"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-success card-outline">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Total Menu</h5>
                        <h3 class="mb-0">{{ $totalMenu }}</h3>
                    </div>
                    <i class="bi bi-egg-fried fs-1"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('food.index') }}" class="text-success stretched-link">Lihat Detail</a>
                <i class="bi bi-chevron-right"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-warning card-outline">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Total Pelanggan</h5>
                        <h3 class="mb-0">{{ $totalCustomers }}</h3>
                    </div>
                    <i class="bi bi-people fs-1"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="#" class="text-warning stretched-link">Lihat Detail</a>
                <i class="bi bi-chevron-right"></i>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">
            <i class="bi bi-table me-2"></i>
            Pesanan Terbaru
        </h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentOrders as $order)
                <tr>
                    <td>#{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $order->tanggal }}</td>
                    <td>Guest</td>
                    <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td>
                        @if ($order->status == 2)
                            <span class="badge bg-success">Selesai</span>
                        @elseif ($order->status == 1)
                            <span class="badge bg-primary">Proses</span>
                        @elseif ($order->status == 3)
                            <span class="badge bg-danger">Batal</span>
                        @else
                            <span class="badge bg-secondary">Baru</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data pesanan terbaru</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 