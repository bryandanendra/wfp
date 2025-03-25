@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row gap-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body text-center p-5">
                    <h3>Makan di Tempat</h3>
                    <p>Nikmati makanan hangat langsung di restoran kami</p>
                    <a href="{{ url('/menu/dinein') }}" class="btn btn-primary">Pilih Menu</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body text-center p-5">
                    <h3>Bawa Pulang</h3>
                    <p>Nikmati makanan di tempat favorit Anda</p>
                    <a href="{{ url('/menu/takeaway') }}" class="btn btn-primary">Pilih Menu</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 