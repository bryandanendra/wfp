@extends('layouts.admin')

@section('title', 'Detail Pesanan')
@section('orders-active', 'active')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title">Detail Pesanan #{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</h4>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 150px">Tanggal</th>
                            <td>: {{ $order->tanggal }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>: 
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
                        </tr>
                    </table>
                </div>
            </div>

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