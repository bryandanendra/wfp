@extends('layouts.admin')

@section('title', 'Daftar Kategori Menu')
@section('kategori-active', 'active')

@section('content')
<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
    @endif
    
    
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title">Daftar Kategori Menu</h4>
                <a href="{{ route('categories.create') }}" class="btn btn-sm" style="background-color: #4D55CC; color: white;">
                    <i class="fas fa-plus me-1"></i> Tambah Kategori
                </a>
            </div>        
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <!-- <th>Produk</th> -->
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description ?? '-' }}</td>
                            <!-- <td>{{ $category->foods->count() }}</td> -->
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm" style="background-color: #7A73D1; color: white;">Edit</a>
                                <button type="button" class="btn btn-sm" style="background-color: #7A73D1; color: white;" data-bs-toggle="modal" data-bs-target="#categoryModal{{ $category->id }}">
                                    Detail</buton>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data kategori</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @foreach($categories as $category)
<div class="modal fade" id="categoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="categoryModalLabel{{ $category->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: blue; color: white;">
                <h5 class="modal-title" id="categoryModalLabel{{ $category->id }}">{{ $category->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Informasi Kategori</h6>
                        <p><strong>Nama:</strong> {{ $category->name }}</p>
                        <!-- <p><strong>ID:</strong> {{ $category->id }}</p>
                        <p><strong>Dibuat pada:</strong> {{ $category->created_at }}</p>
                        <p><strong>Diubah pada:</strong> {{ $category->updated_at }}</p> -->
                        
                        <h6 class="mt-4">Daftar Produk:</h6>
                        <ul class="list-group">
                            @forelse($category->foods as $food)
                                <li class="list-group-item">{{ $food->name }}</li>
                            @empty
                                <li class="list-group-item">Tidak ada produk</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>
@endsection 