@extends('layouts.admin')

@section('title', 'Daftar Makanan')
@section('food-active', 'active')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title">Daftar Makanan</h4>
                <a href="{{ route('food.create') }}" class="btn btn-sm" style="background-color: #4D55CC; color: white;">
                    <i class="fas fa-plus me-1"></i> Tambah Makanan
                </a>
            </div>
            
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
            @endif
            
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
            </div>
            @endif
            
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
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('food.edit', $food->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('food.destroy', $food->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus makanan {{ $food->name }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </div>
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