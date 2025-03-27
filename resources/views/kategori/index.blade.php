@extends('layouts.admin')

@section('title', 'Daftar Kategori')
@section('kategori-active', 'active')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Daftar Kategori</h4>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Product</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategoris as $kategori)
                            <tr>
                                <td>{{ $kategori->id }}</td>
                                <td>{{ $kategori->name }}</td>
                                <td>{{ $kategori->created_at }}</td>
                                <td>{{ $kategori->updated_at }}</td>
                                <td>
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($kategori->foods as $food)
                                            <li>{{$food->name.' - '.$food->price}}</li>
                                        @endforeach
                                    </ul>
                                </td>
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