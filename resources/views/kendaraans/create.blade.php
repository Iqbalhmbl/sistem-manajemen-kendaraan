@extends('layouts.app')

@section('content')
<div class="card bg-dark text-white border-0 shadow-lg">
    <div class="card-header bg-secondary text-white">
        <h1 class="mb-0">Tambah Kendaraan</h1>
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

        <form action="{{ route('kendaraans.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nomor_polisi" class="form-label">Nomor Polisi</label>
                <input type="text" name="nomor_polisi" id="nomor_polisi" class="form-control bg-secondary text-white border-secondary" value="{{ old('nomor_polisi') }}" required>
            </div>
            <div class="mb-3">
                <label for="tipe" class="form-label">Tipe</label>
                <select name="tipe" id="tipe" class="form-select bg-secondary text-white border-secondary" required>
                    <option value="">-- Pilih Tipe --</option>
                    <option value="angkut_orang" {{ old('tipe') == 'angkut_orang' ? 'selected' : '' }}>Angkut Orang</option>
                    <option value="angkut_barang" {{ old('tipe') == 'angkut_barang' ? 'selected' : '' }}>Angkut Barang</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="kepemilikan" class="form-label">Kepemilikan</label>
                <select name="kepemilikan" id="kepemilikan" class="form-select bg-secondary text-white border-secondary" required>
                    <option value="">-- Pilih Kepemilikan --</option>
                    <option value="perusahaan" {{ old('kepemilikan') == 'perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                    <option value="sewa" {{ old('kepemilikan') == 'sewa' ? 'selected' : '' }}>Sewa</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="merk" class="form-label">Merk</label>
                <input type="text" name="merk" id="merk" class="form-control bg-secondary text-white border-secondary" value="{{ old('merk') }}" required>
            </div>
            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" name="model" id="model" class="form-control bg-secondary text-white border-secondary" value="{{ old('model') }}" required>
            </div>
            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun</label>
                <input type="number" name="tahun" id="tahun" class="form-control bg-secondary text-white border-secondary" value="{{ old('tahun') }}" min="1900" max="{{ date('Y') + 1 }}" required>
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
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select bg-secondary text-white border-secondary" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="tidak_aktif" {{ old('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('kendaraans.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
