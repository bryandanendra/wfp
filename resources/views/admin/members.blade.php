@extends('layouts.admin')

@section('title', 'Daftar Member')
@section('members-active', 'active')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Daftar Member</h4>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Member</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Poin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($members as $member)
                        <tr>
                            <td>MBR{{ str_pad($member->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->email }}</td>
                            <td>{{ $member->phone }}</td>
                            <td>{{ $member->points }}</td>
                            <td>
                                <a href="{{ route('members.edit', $member->id) }}" class="btn btn-sm" style="background-color: #7A73D1; color: white;">Edit</a>
                                <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="background-color: #211C84; color: white;" onclick="return confirm('Apakah Anda yakin ingin menghapus member ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data member</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 