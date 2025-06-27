@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Pegawai</div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Pegawai</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $pegawai->nama) }}" required>
            </div>

            <div class="mb-3">
                <label>Jabatan</label>
                <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $pegawai->jabatan) }}" required>
            </div>

            <hr>
            <h5>Akun User (Login)</h5>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="user[email]" class="form-control" value="{{ old('user.email', $pegawai->user->email ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label>Password (Biarkan kosong jika tidak diubah)</label>
                <input type="password" name="user[password]" class="form-control">
            </div>

            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
