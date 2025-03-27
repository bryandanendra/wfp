@extends('layouts.admin')

@section('title', 'Daftar Makanan')
@section('food-active', 'active')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Daftar Makanan</h4>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Price</th>
                            <th>Decription</th>
                            <th>Category</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($foods as $food)
                            <tr>
                                <td>{{ $food->id }}</td>
                                <td>{{ $food->name }}</td>
                                <td>{{ $food->price }}</td>
                                <td>{{ $food->description }}</td>
                                <td>{{ $food->category}}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning">Edit</button>
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </td>                   
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection