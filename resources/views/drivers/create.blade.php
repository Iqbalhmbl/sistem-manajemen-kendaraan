@extends('layouts.app')

@section('content')
<div class="card bg-dark text-white border-0 shadow-lg">
    <div class="card-header bg-secondary text-white">
        <h1 class="mb-0">Tambah Driver</h1>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger bg-opacity-75">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('drivers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control bg-secondary text-white border-secondary" value="{{ old('nama') }}" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">No HP</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control bg-secondary text-white border-secondary" value="{{ old('no_hp') }}" required>
            </div>
            <div class="mb-3">
                <label for="region_id" class="form-label">Region</label>
                <select name="region_id" id="region_id" class="form-select bg-secondary text-white border-secondary" required>
                    <option value="">-- Pilih Region --</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                            {{ $region->nama_region }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
