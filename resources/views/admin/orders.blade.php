@extends('layouts.adminlte')

@section('title', 'Daftar Pesanan')
@section('orders-active', 'active')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="bi bi-table me-2"></i>
            Daftar Pesanan
        </h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Tipe</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                <tr>
                    <td>#{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $order->tanggal }}</td>
                    <td>Guest</td>
                    <td>Dine-in</td>
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
                    <td colspan="7" class="text-center">Tidak ada data pesanan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 