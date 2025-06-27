@extends('layouts.app')

@section('content')
<div class="card bg-dark text-white border-0 shadow-lg">
    <div class="card-header bg-secondary text-white">
        <h1 class="mb-0">Detail Kendaraan</h1>
    </div>
    <div class="card-body">
        <p><strong>Nomor Polisi:</strong> {{ $kendaraan->nomor_polisi }}</p>
        <p><strong>Tipe:</strong> {{ ucfirst(str_replace('_', ' ', $kendaraan->tipe)) }}</p>
        <p><strong>Kepemilikan:</strong> {{ ucfirst($kendaraan->kepemilikan) }}</p>
        <p><strong>Merk:</strong> {{ $kendaraan->merk }}</p>
        <p><strong>Model:</strong> {{ $kendaraan->model }}</p>
        <p><strong>Tahun:</strong> {{ $kendaraan->tahun }}</p>
        <p><strong>Region:</strong> {{ $kendaraan->region->nama_region ?? '-' }}</p>
        <p><strong>Status:</strong> {{ ucfirst($kendaraan->status) }}</p>

        <a href="{{ route('kendaraans.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection
