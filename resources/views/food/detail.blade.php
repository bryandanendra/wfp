@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Detail Makanan</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="https://via.placeholder.com/300" class="img-fluid rounded" alt="{{ $food->name }}">
                        </div>
                        <div class="col-md-8">
                            <h2>{{ $food->name }}</h2>
                            <p class="text-muted">Kategori: {{ $food->category->name }}</p>
                            
                            <div class="mb-3">
                                <h4 class="text-primary">Rp {{ number_format($food->price, 2) }}</h4>
                            </div>
                            
                            <div class="mb-3">
                                <h5>Deskripsi:</h5>
                                <p>{{ $food->description ?? 'Tidak ada deskripsi' }}</p>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <a href="{{ url('/') }}" class="btn btn-secondary">Kembali</a>
                                <a href="{{ url('/before_order') }}" class="btn btn-primary">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 