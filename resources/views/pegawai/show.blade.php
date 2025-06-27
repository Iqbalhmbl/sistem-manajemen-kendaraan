@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Detail Supplier</span>
        <a href="{{ route('suppliers.edit', $supplier->uuid) }}" class="btn btn-sm btn-warning">Edit</a>
    </div>
    <div class="card-body">
        <h5 class="mb-3">Informasi Umum</h5>
        <table class="table table-bordered">
            <tr>
                <th width="200">Nama</th>
                <td>{{ $supplier->name }}</td>
            </tr>
            <tr>
                <th>Telepon (Perusahaan)</th>
                <td>{{ $supplier->phone }}</td>
            </tr>
            <tr>
                <th>Website</th>
                <td>{{ $supplier->website ?? '-' }}</td>
            </tr>
            <tr>
                <th>NPWP</th>
                <td>{{ $supplier->npwp ?? '-' }}</td>
            </tr>
            <tr>
                <th>Catatan</th>
                <td>{{ $supplier->notes ?? '-' }}</td>
            </tr>
        </table>

        <h5 class="mt-4 mb-3">Contact Person</h5>
        <table class="table table-bordered">
            <tr>
                <th width="200">Nama</th>
                <td>{{ $supplier->contact_person['name'] ?? '-' }}</td>
            </tr>
            <tr>
                <th>Posisi</th>
                <td>{{ $supplier->contact_person['position'] ?? '-' }}</td>
            </tr>
            <tr>
                <th>Telepon</th>
                <td>{{ $supplier->contact_person['phone'] ?? '-' }}</td>
            </tr>
        </table>

        <h5 class="mt-4 mb-3">Alamat</h5>
        <table class="table table-bordered">
            <tr>
                <th width="200">Jalan</th>
                <td>{{ $supplier->address['street'] ?? '-' }}</td>
            </tr>
            <tr>
                <th>Kota</th>
                <td>{{ $supplier->address['city'] ?? '-' }}</td>
            </tr>
            <tr>
                <th>Provinsi</th>
                <td>{{ $supplier->address['province'] ?? '-' }}</td>
            </tr>
            <tr>
                <th>Kode Pos</th>
                <td>{{ $supplier->address['postal_code'] ?? '-' }}</td>
            </tr>
        </table>
        <a href="{{ route('suppliers.index') }}" class="btn btn-sm btn-secondary">← Back</a>
    </div>
</div>
@endsection
