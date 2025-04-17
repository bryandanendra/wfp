@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="text-center my-4">
        <h1 class="display-4">Syopi pud</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header" style="background-color: #0d6efd; color: white;">
                    <h5 class="mb-0 text-center">Daftar Kategori Section</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Dibuat pada</th>
                                <th>Diubah pada</th>
                                <!-- <th>Produk</th> -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>{{ $category->updated_at }}</td>
                                <!-- <td>
                                    @foreach($category->foods as $food)
                                        {{ $food->name }}@if(!$loop->last), @endif
                                    @endforeach
                                </td> -->
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal{{ $category->id }}">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk setiap kategori -->
@foreach($categories as $category)
<div class="modal fade" id="categoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="categoryModalLabel{{ $category->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0d6efd; color: white;">
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
@endsection
