@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center bg-light">
    <div class="text-center">
        <h1 class="display-1 mb-4">Food Ordering UBAYA</h1>
        <p class="lead mb-5">Pesan makanan favorit Anda dengan mudah dan cepat</p>
        <a href="{{ url('/before_order') }}" class="btn btn-info btn-lg px-5">
            Mulai Pesan
        </a>
    </div>
</div>
@endsection
