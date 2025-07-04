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
    
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
    </div>
    @endif
    
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title">Daftar Kategori Menu</h4>
                <div>
                    <button type="button" class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#btnFormModal">
                        <i class="fas fa-plus"></i> New Category (Modal)
                    </button>
                    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> New Category
                    </a>
                </div>
            </div>        
            <div class="table-responsive">
                <h4>Category with Hover Rows</h4>
                
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Number of Food</th>
                            <th style="width: 280px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr id="tr_{{ $category->id }}">
                            <td>{{ $category->id }}</td>
                            <td id="td_name_{{ $category->id }}">{{ $category->name }}</td>
                            <td>{{ $category->description ?? '-' }}</td>
                            <td>{{ $category->foods->count() }}</td>
                            <td>
                                <div class="d-flex gap-1 flex-wrap">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    
                                    <a href="#modalEditA" class="btn btn-sm btn-warning" data-bs-toggle="modal" 
                                    onclick="getEditForm({{ $category->id }})">
                                        <i class="fas fa-edit"></i> Type A
                                    </a>
                                    
                                    <a href="#modalEditB" class="btn btn-sm btn-info" data-bs-toggle="modal" 
                                    onclick="getEditFormB({{ $category->id }})">
                                        <i class="fas fa-bolt"></i> Type B
                                    </a>
                                    
                                    <a href="#" class="btn btn-sm btn-danger"
                                    onclick="if(confirm('Are you sure to delete {{ $category->id }} - {{ $category->name }} ? '))
                                    deleteDataRemove({{ $category->id }})">
                                        <i class="fas fa-trash"></i> No-Reload
                                    </a>
                                    
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" 
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $category->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
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
</div>

<!-- Modal Form Add New Category -->
@push('modals')
<div class="modal fade" id="btnFormModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Category</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="name"
                               placeholder="Enter Category Name">
                        <small id="name" class="form-text text-muted">Please write down Category Name here.</small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Category Description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endpush

<!-- Modal Edit Form Type A -->
<div class="modal fade" id="modalEditA" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Category</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">
                {{-- You can put animated loading image here... --}}
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Form Type B -->
<div class="modal fade" id="modalEditB" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Quick Edit Category</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContentB">
                {{-- You can put animated loading image here... --}}
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    function getEditForm(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("kategori.getEditForm") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id
            },
            success: function(data) {
                $('#modalContent').html(data.msg)
            }
        });
    }
    
    function getEditFormB(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("kategori.getEditFormB") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id
            },
            success: function(data) {
                $('#modalContentB').html(data.msg)
            }
        });
    }
    
    function saveDataUpdate(id) {
        var name = $('#ename').val();
        var description = $('#edescription').val();
        
        console.log(name); //debug->print to browser console
        $.ajax({
            type: 'POST',
            url: '{{ route("kategori.saveDataUpdate") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id,
                'name': name,
                'description': description
            },
            success: function(data) {
                if (data.status == "oke") {
                    $('#td_name_' + id).html(name);
                    $('#modalEditB').modal('hide');
                    // Tambahkan notifikasi sukses
                    alert('Data successfully updated!');
                }
            }
        });
    }
    
    function deleteDataRemove(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("kategori.deleteData") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id
            },
            success: function(data) {
                if(data.status == "oke") {
                    $('#tr_'+id).remove();
                    // Tambahkan notifikasi sukses
                    alert('Data successfully deleted!');
                } else {
                    alert(data.msg);
                }
            }
        });
    }
</script>
@endpush

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
                        <p><strong>Deskripsi:</strong> {{ $category->description ?? '-' }}</p>
                        
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