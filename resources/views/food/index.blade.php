@extends('layouts.admin')

@section('title', 'Daftar Menu Makanan')
@section('food-active', 'active')

@section('content')
<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title">Daftar Menu Makanan</h4>
                <div>
                    <button type="button" class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#btnFormModal">
                        <i class="fas fa-plus"></i> New Food (Modal)
                    </button>
                    <a href="{{ route('food.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> New Food
                    </a>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th style="width: 280px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($foods as $food)
                        <tr id="tr_{{ $food->id }}">
                            <td>{{ $food->id }}</td>
                            <td id="td_name_{{ $food->id }}">{{ $food->name }}</td>
                            <td>{{ $food->description }}</td>
                            <td>{{ number_format($food->price, 0, ',', '.') }}</td>
                            <td>{{ $food->category->name ?? '-' }}</td>
                            <td>
                                <div class="d-flex gap-1 flex-wrap">
                                    <a href="{{ route('food.edit', $food->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    
                                    <a href="#modalEditA" class="btn btn-sm btn-warning" data-bs-toggle="modal" 
                                    onclick="getEditForm({{ $food->id }})">
                                        <i class="fas fa-edit"></i> Type A
                                    </a>
                                    
                                    <a href="#modalEditB" class="btn btn-sm btn-info" data-bs-toggle="modal" 
                                    onclick="getEditFormB({{ $food->id }})">
                                        <i class="fas fa-bolt"></i> Type B
                                    </a>
                                    
                                    <a href="#" class="btn btn-sm btn-danger"
                                    onclick="if(confirm('Are you sure to delete {{ $food->id }} - {{ $food->name }} ? '))
                                    deleteDataRemove({{ $food->id }})">
                                        <i class="fas fa-trash"></i> No-Reload
                                    </a>
                                    
                                    <form action="{{ route('food.destroy', $food->id) }}" method="POST" class="d-inline" 
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu {{ $food->name }}?');">
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
                            <td colspan="6" class="text-center">Tidak ada data menu</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Form Add New Food -->
@push('modals')
<div class="modal fade" id="btnFormModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Food</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('food.store') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="name"
                               placeholder="Enter Food Name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Food Description"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nutritions_fact">Nutritions Fact</label>
                        <textarea class="form-control" id="nutritions_fact" name="nutritions_fact" rows="3" placeholder="Enter Nutritions Fact"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price">
                    </div>
                    <div class="form-group mb-3">
                        <label for="category_id">Category</label>
                        <select class="form-control" id="category_id" name="category_id">
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
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
                <h4 class="modal-title">Edit Food</h4>
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
                <h4 class="modal-title">Quick Edit Food</h4>
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
            url: '{{ route("food.getEditForm") }}',
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
            url: '{{ route("food.getEditFormB") }}',
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
        var nutritions_fact = $('#enutritions_fact').val();
        var price = $('#eprice').val();
        var category_id = $('#ecategory_id').val();
        
        $.ajax({
            type: 'POST',
            url: '{{ route("food.saveDataUpdate") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id,
                'name': name,
                'description': description,
                'nutritions_fact': nutritions_fact,
                'price': price,
                'category_id': category_id
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
            url: '{{ route("food.deleteData") }}',
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

@endsection