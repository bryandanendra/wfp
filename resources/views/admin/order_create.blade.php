@extends('layouts.admin')

@section('title', 'Tambah Pesanan Baru')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Pesanan Baru</h3>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal Pesanan</label>
                                    <input type="datetime-local" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d\TH:i')) }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Baru</option>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Proses</option>
                                        <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Selesai</option>
                                        <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>Batal</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="member_id">Member (Opsional)</label>
                            <select class="form-control @error('member_id') is-invalid @enderror" id="member_id" name="member_id">
                                <option value="">-- Pilih Member --</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                        {{ $member->name }} ({{ $member->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('member_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <h4 class="mt-4">Detail Pesanan</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="orderItems">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th style="width: 150px">Jumlah</th>
                                        <th style="width: 100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="food_ids[]" class="form-control menu-select" required>
                                                <option value="">-- Pilih Menu --</option>
                                                @foreach($foods as $food)
                                                    <option value="{{ $food->id }}" data-price="{{ $food->price }}">
                                                        {{ $food->name }} - Rp {{ number_format($food->price, 0, ',', '.') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="quantities[]" class="form-control quantity" value="1" min="1" required>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm btn-remove-item">Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">
                                            <button type="button" class="btn btn-success btn-sm" id="addItem">Tambah Item</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="form-group mt-4 text-right">
                            <span class="h4 mr-3">Total: Rp <span id="grandTotal">0</span></span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan Pesanan</button>
                            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update total ketika halaman dimuat
        calculateTotal();
        
        // Tambah item baru
        document.getElementById('addItem').addEventListener('click', function() {
            const tbody = document.querySelector('#orderItems tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>
                    <select name="food_ids[]" class="form-control menu-select" required>
                        <option value="">-- Pilih Menu --</option>
                        @foreach($foods as $food)
                            <option value="{{ $food->id }}" data-price="{{ $food->price }}">
                                {{ $food->name }} - Rp {{ number_format($food->price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="quantities[]" class="form-control quantity" value="1" min="1" required>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm btn-remove-item">Hapus</button>
                </td>
            `;
            tbody.appendChild(newRow);
            
            // Tambahkan event listener untuk menu dan quantity baru
            addEventListeners(newRow);
        });
        
        // Hapus item
        document.querySelector('#orderItems tbody').addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-remove-item')) {
                const rowCount = document.querySelectorAll('#orderItems tbody tr').length;
                if (rowCount > 1) {
                    e.target.closest('tr').remove();
                    calculateTotal();
                } else {
                    alert('Minimal harus ada satu item menu!');
                }
            }
        });
        
        // Event listeners untuk baris pertama
        const firstRow = document.querySelector('#orderItems tbody tr');
        addEventListeners(firstRow);
        
        // Fungsi untuk menambahkan event listeners
        function addEventListeners(row) {
            row.querySelector('.menu-select').addEventListener('change', calculateTotal);
            row.querySelector('.quantity').addEventListener('input', calculateTotal);
        }
        
        // Hitung total pesanan
        function calculateTotal() {
            let total = 0;
            const rows = document.querySelectorAll('#orderItems tbody tr');
            
            rows.forEach(row => {
                const select = row.querySelector('.menu-select');
                const quantity = row.querySelector('.quantity');
                
                if (select.value) {
                    const selectedOption = select.options[select.selectedIndex];
                    const price = parseFloat(selectedOption.getAttribute('data-price'));
                    const qty = parseInt(quantity.value) || 0;
                    
                    total += price * qty;
                }
            });
            
            document.getElementById('grandTotal').textContent = total.toLocaleString('id-ID');
        }
    });
</script>
@endsection 