@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Add Pegawai</div>
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
        <form action="{{ route('pegawai.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Pegawai</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>

            <div class="mb-3">
                <label>Jabatan</label>
                <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan') }}" required>
            </div>

            <hr>
            <h5>Akun User (Login)</h5>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="user[email]" class="form-control" value="{{ old('user.email') }}" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="user[password]" class="form-control" required>
            </div>

            <button class="btn btn-success">Save</button>
        </form>
    </div>
</div>
@endsection
