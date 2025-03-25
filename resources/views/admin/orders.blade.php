@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Daftar Pesanan</h2>
    
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Tanggal</th>
                        <th>Tipe</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#001</td>
                        <td>2025-02-27</td>
                        <td>Dine-in</td>
                        <td>Rp 150.000</td>
                        <td><span class="badge bg-success">Selesai</span></td>
                        <td>
                            <button class="btn btn-sm btn-info">Detail</button>
                        </td>
                    </tr>
                    <tr>
                        <td>#002</td>
                        <td>2025-02-27</td>
                        <td>Take-away</td>
                        <td>Rp 85.000</td>
                        <td><span class="badge bg-warning">Proses</span></td>
                        <td>
                            <button class="btn btn-sm btn-info">Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 