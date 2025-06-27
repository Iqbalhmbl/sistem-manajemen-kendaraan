@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Pasien</div>
    <div class="card-body">
        <form action="{{ route('pasien.update', $pasien->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $pasien->nama }}" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" required>{{ $pasien->alamat }}</textarea>
            </div>
            <div class="mb-3">
                <label for="wilayah_id" class="form-label">Wilayah</label>
                <select name="wilayah_id" class="form-select" required>
                    @foreach($wilayahs as $wilayah)
                        <option value="{{ $wilayah->id }}" {{ $wilayah->id == $pasien->wilayah_id ? 'selected' : '' }}>
                            {{ $wilayah->nama_wilayah }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="{{ $pasien->tanggal_lahir }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
