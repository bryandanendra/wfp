@extends('layouts.adminlte')

@section('title', 'Detail Pesanan')
@section('orders-active', 'active')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">
                <i class="bi bi-info-circle me-2"></i>
                Detail Pesanan #{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}
            </h3>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Pesanan</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table">
                            <tr>
                                <th style="width: 150px">Tanggal</th>
                                <td>{{ $order->tanggal }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
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
                            </tr>
                            <tr>
                                <th>Pelanggan</th>
                                <td>Guest</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Detail Item</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($orderDetails as $index => $item)
                        @php 
                            $subtotal = $item->quantity * $item->harga_jual;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">Total</th>
                            <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 