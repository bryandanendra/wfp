@extends('layouts.admin')

@section('title', 'Detail Menu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Menu</h3>
                    <div class="card-tools">
                        <a href="{{ route('food.edit', $food->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <a href="{{ route('food.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 200px">Nama Menu</th>
                            <td>{{ $food->name }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $food->description }}</td>
                        </tr>
                        <tr>
                            <th>Informasi Nutrisi</th>
                            <td>{{ $food->nutritions_fact }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>Rp {{ number_format($food->price, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $food->category->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 