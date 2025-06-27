@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Data Pasien</span>
        <a href="{{ route('pasien.create') }}" class="btn btn-sm btn-success">+ Tambah Pasien</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" class="mb-3 d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Cari nama pasien..." value="{{ request('search') }}">
            <button class="btn btn-primary">Cari</button>
        </form>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Wilayah</th>
                    <th>Tanggal Lahir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pasiens as $index => $pasien)
                <tr>
                    <td>{{ $index + $pasiens->firstItem() }}</td>
                    <td>{{ $pasien->nama }}</td>
                    <td>{{ $pasien->alamat }}</td>
                    <td>{{ $pasien->wilayah->nama_wilayah ?? '-' }}</td>
                    <td>{{ $pasien->tanggal_lahir }}</td>
                    <td>
                        <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    @role('admin')
                        <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus pasien ini?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    @endrole
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $pasiens->links() }}
    </div>
</div>
@endsection
