@extends('layouts.app')

@section('content')
<div class="card bg-dark text-white border-0 shadow-lg">
    <div class="card-header bg-secondary text-white">
        <h1 class="mb-0">Tambah Region</h1>
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

        <form action="{{ route('regions.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_region" class="form-label">Nama Region</label>
                <input type="text" name="nama_region" id="nama_region" class="form-control bg-secondary text-white border-secondary" value="{{ old('nama_region') }}" required>
            </div>
            <div class="mb-3">
                <label for="tipe" class="form-label">Tipe</label>
                <select name="tipe" id="tipe" class="form-select bg-secondary text-white border-secondary" required>
                    <option value="">-- Pilih Tipe --</option>
                    <option value="kantor_pusat" {{ old('tipe')=='kantor_pusat' ? 'selected' : '' }}>Kantor Pusat</option>
                    <option value="kantor_cabang" {{ old('tipe')=='kantor_cabang' ? 'selected' : '' }}>Kantor Cabang</option>
                    <option value="tambang" {{ old('tipe')=='tambang' ? 'selected' : '' }}>Tambang</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control bg-secondary text-white border-secondary" rows="3" required>{{ old('alamat') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('regions.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
