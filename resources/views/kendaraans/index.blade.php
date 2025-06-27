@extends('layouts.app')

@section('content')
<div class="card bg-dark text-white border-0 shadow-lg">
    <div class="card-header d-flex justify-content-between align-items-center bg-secondary text-white rounded-top-4">
        <span>Data Kendaraan</span>
        <a href="{{ route('kendaraans.create') }}" class="btn btn-sm btn-success">+ Tambah Kendaraan</a>
    </div>
    <div class="card-body">
        <form method="GET" class="mb-3 d-flex gap-2">
            <input type="text" name="search" class="form-control bg-secondary text-white border-secondary" placeholder="Cari nomor polisi, merk, model..." value="{{ request('search') }}">
            <button class="btn btn-secondary">Cari</button>
        </form>

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
                        <th>Nomor Polisi</th>
                        <th>Tipe</th>
                        <th>Kepemilikan</th>
                        <th>Merk</th>
                        <th>Model</th>
                        <th>Tahun</th>
                        <th>Region</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kendaraans as $index => $vehicle)
                    <tr>
                        <td>{{ $kendaraans->firstItem() + $index }}</td>
                        <td>{{ $vehicle->nomor_polisi }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $vehicle->tipe)) }}</td>
                        <td>{{ ucfirst($vehicle->kepemilikan) }}</td>
                        <td>{{ $vehicle->merk }}</td>
                        <td>{{ $vehicle->model }}</td>
                        <td>{{ $vehicle->tahun }}</td>
                        <td>{{ $vehicle->region->nama_region ?? '-' }}</td>
                        <td>{{ ucfirst($vehicle->status) }}</td>
                        <td>
                            <a href="{{ route('kendaraans.show', $vehicle->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('kendaraans.edit', $vehicle->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('kendaraans.destroy', $vehicle->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
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

        {{ $kendaraans->links() }}
    </div>
</div>
@endsection
