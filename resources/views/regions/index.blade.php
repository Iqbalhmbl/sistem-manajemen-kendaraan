@extends('layouts.app')

@section('content')
<div class="card bg-dark text-white border-0 shadow-lg">
    <div class="card-header d-flex justify-content-between align-items-center bg-secondary text-white rounded-top-4">
        <span>Data Regions</span>
        <a href="{{ route('regions.create') }}" class="btn btn-sm btn-success">
            + Tambah Region
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
                        <th>Nama Region</th>
                        <th>Tipe</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($regions as $index => $region)
                    <tr>
                        <td>{{ $regions->firstItem() + $index }}</td>
                        <td>{{ $region->nama_region }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $region->tipe)) }}</td>
                        <td>{{ $region->alamat }}</td>
                        <td>
                            <a href="{{ route('regions.show', $region->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('regions.edit', $region->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('regions.destroy', $region->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
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

        {{ $regions->links() }}
    </div>
</div>
@endsection
