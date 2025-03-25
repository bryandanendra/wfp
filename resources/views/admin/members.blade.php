@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Daftar Member</h2>
    
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Member</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. Telepon</th>
                        <th>Poin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>MBR001</td>
                        <td>Sam Khang</td>
                        <td>Khang@example.com</td>
                        <td>081234567890</td>
                        <td>250</td>
                        <td>
                            <button class="btn btn-sm btn-warning">Edit</button>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>MBR002</td>
                        <td>Simun Jawa</td>
                        <td>Jaw@example.com</td>
                        <td>081234567891</td>
                        <td>180</td>
                        <td>
                            <button class="btn btn-sm btn-warning">Edit</button>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 