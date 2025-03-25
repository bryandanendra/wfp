@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Menu {{ ucfirst($type) }}</h2>
    
    <div class="row g-4">
        @php
            $menus = [
                ['name' => 'Nasi Goreng', 'price' => '35.000', 'category' => 'Main Course'],
                ['name' => 'Sate Ayam', 'price' => '30.000', 'category' => 'Main Course'],
                ['name' => 'Ayam Geprek', 'price' => '15.000', 'category' => 'Main Course'],
                ['name' => 'Es Teh', 'price' => '8.000', 'category' => 'Minuman'],
                ['name' => 'Es Jeruk', 'price' => '5.000', 'category' => 'Minuman']
                
            ];
        @endphp

        @foreach($menus as $menu)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $menu['name'] }}</h5>
                    <p class="card-text">Rp {{ $menu['price'] }}</p>
                    <p class="card-text"><small class="text-muted">{{ $menu['category'] }}</small></p>
                    <button class="btn btn-primary">Tambah ke Keranjang</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection 