@extends('layouts.admin')

@section('title', 'Daftar Order')
@section('order-active', 'active')

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
                <h4 class="card-title">Daftar Order</h4>
                <div>
                    <button type="button" class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#btnFormModal">
                        <i class="fas fa-plus"></i> New Order (Modal)
                    </button>
                    <a href="{{ route('orders.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> New Order
                    </a>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Member</th>
                            <th>Total</th>
                            <th style="width: 280px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr id="tr_{{ $order->id }}">
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->tanggal }}</td>
                            <td id="td_status_{{ $order->id }}">
                                <span class="badge bg-{{ 
                                    $order->status == 'new' ? 'primary' : 
                                    ($order->status == 'process' ? 'warning' : 
                                    ($order->status == 'done' ? 'success' : 'danger')) 
                                }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>{{ ucfirst($order->type) }}</td>
                            <td>{{ $order->member->name ?? 'Guest' }}</td>
                            <td>{{ number_format($order->foods->sum('pivot.subtotal'), 0, ',', '.') }}</td>
                            <td>
                                <div class="d-flex gap-1 flex-wrap">
                                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    
                                    <a href="#modalEditA" class="btn btn-sm btn-warning" data-bs-toggle="modal" 
                                    onclick="getEditForm({{ $order->id }})">
                                        <i class="fas fa-edit"></i> Type A
                                    </a>
                                    
                                    <a href="#modalEditB" class="btn btn-sm btn-info" data-bs-toggle="modal" 
                                    onclick="getEditFormB({{ $order->id }})">
                                        <i class="fas fa-bolt"></i> Type B
                                    </a>
                                    
                                    <a href="#" class="btn btn-sm btn-danger"
                                    onclick="if(confirm('Are you sure to delete Order #{{ $order->id }}?'))
                                    deleteDataRemove({{ $order->id }})">
                                        <i class="fas fa-trash"></i> No-Reload
                                    </a>
                                    
                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline" 
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus Order #{{ $order->id }}?');">
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
                            <td colspan="7" class="text-center">Tidak ada data order</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Form Add New Order -->
@push('modals')
<div class="modal fade" id="btnFormModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Order</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('orders.store') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="new">New</option>
                            <option value="process">Process</option>
                            <option value="done">Done</option>
                            <option value="cancel">Cancel</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type">
                            <option value="dinein">Dine In</option>
                            <option value="takeaway">Take Away</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="member_id">Member</label>
                        <select class="form-control" id="member_id" name="member_id">
                            <option value="">-- Pilih Member --</option>
                            @foreach(\App\Models\Member::all() as $member)
                                <option value="{{ $member->id }}">{{ $member->name }}</option>
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
                <h4 class="modal-title">Edit Order</h4>
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
                <h4 class="modal-title">Quick Edit Order</h4>
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
            url: '{{ route("orders.getEditForm") }}',
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
            url: '{{ route("orders.getEditFormB") }}',
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
        var tanggal = $('#etanggal').val();
        var status = $('#estatus').val();
        var type = $('#etype').val();
        var member_id = $('#emember_id').val();
        
        $.ajax({
            type: 'POST',
            url: '{{ route("orders.saveDataUpdate") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id,
                'tanggal': tanggal,
                'status': status,
                'type': type,
                'member_id': member_id
            },
            success: function(data) {
                if (data.status == "oke") {
                    // Perbarui status dengan badge yang sesuai
                    var badgeClass = '';
                    if (status == 'new') badgeClass = 'bg-primary';
                    else if (status == 'process') badgeClass = 'bg-warning';
                    else if (status == 'done') badgeClass = 'bg-success';
                    else badgeClass = 'bg-danger';
                    
                    $('#td_status_' + id).html('<span class="badge ' + badgeClass + '">' + status.charAt(0).toUpperCase() + status.slice(1) + '</span>');
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
            url: '{{ route("orders.deleteData") }}',
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