@extends('layouts.app')

@section('content')
<div class="card bg-dark text-white border-0 shadow-lg">
    <div class="card-header d-flex justify-content-between align-items-center bg-secondary text-white rounded-top-4">
        <span>Data Drivers</span>
        <a href="{{ route('drivers.create') }}" class="btn btn-sm btn-success">
            + Tambah Driver
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-dark align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No HP</th>
                        <th>Region</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($drivers as $index => $driver)
                    <tr>
                        <td>{{ $drivers->firstItem() + $index }}</td>
                        <td>{{ $driver->nama }}</td>
                        <td>{{ $driver->no_hp }}</td>
                        <td>{{ $driver->region->nama_region ?? '-' }}</td>
                        <td>
                            <a href="{{ route('drivers.show', $driver->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $drivers->links() }}
    </div>
</div>
@endsection
