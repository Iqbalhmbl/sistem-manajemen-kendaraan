@extends('layouts.app')

@section('content')
<div class="card bg-dark text-white border-0 shadow-lg">
    <div class="card-header bg-secondary text-white">
        Add New User
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
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group mb-2">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" class="form-control bg-secondary text-white border-secondary" required>
            </div>
            <div class="form-group mb-2">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" class="form-control bg-secondary text-white border-secondary" required>
            </div>
            <div class="form-group mb-2">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" class="form-control bg-secondary text-white border-secondary" required>
            </div>
            <div class="form-group mb-2">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control bg-secondary text-white border-secondary" required>
            </div>
            <div class="form-group mb-2">
                <label for="role">Role</label>
                <select id="role" name="role" class="form-control bg-secondary text-white border-secondary" required>
                    <option value="">-- Select Role --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->uuid }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-secondary mt-2">Save</button>
        </form>
    </div>
</div>
@endsection
