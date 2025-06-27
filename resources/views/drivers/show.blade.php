@extends('layouts.app')

@section('content')
<div class="card bg-dark text-white border-0 shadow-lg">
    <div class="card-header bg-secondary text-white">
        <h1 class="mb-0">Detail Driver</h1>
    </div>
    <div class="card-body">
        <p><strong>Nama:</strong> {{ $driver->nama }}</p>
        <p><strong>No HP:</strong> {{ $driver->no_hp }}</p>
        <p><strong>Region:</strong> {{ $driver->region->nama_region ?? '-' }}</p>

        <a href="{{ route('drivers.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection
