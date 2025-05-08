@extends('layouts.admin')

@section('title', 'Detail Pesanan')
@section('orders-active', 'active')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title">Detail Pesanan #{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</h4>
                <a href="{{ route('orders.index') }}" class="btn btn-sm" style="background-color: #211C84; color: white;">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card" style="border-top: 3px solid var(--primary-medium);">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Informasi Pesanan</h5>
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

            <div class="card" style="border-top: 3px solid var(--primary-light);">
                <div class="card-body">
                    <h5 class="card-title mb-3">Detail Item</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
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
                                <tr class="table-secondary">
                                    <th colspan="4" class="text-end">Total</th>
                                    <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 