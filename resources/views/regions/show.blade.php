@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Region</h1>
    <div class="card">
        <div class="card-body">
            <h5>Nama Region:</h5>
            <p>{{ $region->nama_region }}</p>

            <h5>Tipe:</h5>
            <p>{{ ucfirst(str_replace('_', ' ', $region->tipe)) }}</p>

            <h5>Alamat:</h5>
            <p>{{ $region->alamat }}</p>

            <a href="{{ route('regions.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection
