@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Region</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('regions.update', $region->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_region" class="form-label">Nama Region</label>
            <input type="text" name="nama_region" id="nama_region" class="form-control" value="{{ old('nama_region', $region->nama_region) }}" required>
        </div>
        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe</label>
            <select name="tipe" id="tipe" class="form-select" required>
                <option value="kantor_pusat" {{ $region->tipe == 'kantor_pusat' ? 'selected' : '' }}>Kantor Pusat</option>
                <option value="kantor_cabang" {{ $region->tipe == 'kantor_cabang' ? 'selected' : '' }}>Kantor Cabang</option>
                <option value="tambang" {{ $region->tipe == 'tambang' ? 'selected' : '' }}>Tambang</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ old('alamat', $region->alamat) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('regions.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
