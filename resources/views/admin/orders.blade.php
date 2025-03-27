@extends('layouts.admin')

@section('title', 'Daftar Pesanan')
@section('orders-active', 'active')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Daftar Pesanan</h4>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
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
                                    <span class="badge" style="background-color: #7A73D1;">Selesai</span>
                                @elseif ($order->status == 1)
                                    <span class="badge" style="background-color: #B5A8D5; color: #211C84;">Proses</span>
                                @elseif ($order->status == 3)
                                    <span class="badge" style="background-color: #f06060;">Batal</span>
                                @else
                                    <span class="badge" style="background-color: #211C84;">Baru</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm" style="background-color: #4D55CC; color: white;">Detail</a>
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
    </div>
</div>
@endsection 