@extends('layouts.app')

@section('content')
<div class="card bg-dark text-white border-0 shadow-lg">
    <div class="card-header bg-secondary text-white">
        Edit User
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
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-2">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ $user->name }}" class="form-control bg-secondary text-white border-secondary" required>
            </div>
            <div class="form-group mb-2">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ $user->email }}" class="form-control bg-secondary text-white border-secondary" required>
            </div>
            <div class="form-group mb-2">
                <label for="password">New Password (optional)</label>
                <input id="password" type="password" name="password" class="form-control bg-secondary text-white border-secondary">
            </div>
            <div class="form-group mb-2">
                <label for="password_confirmation">Confirm New Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control bg-secondary text-white border-secondary">
            </div>
            <div class="form-group mb-2">
                <label for="role">Role</label>
                <select id="role" name="role" class="form-control bg-secondary text-white border-secondary" required>
                    <option value="">-- Select Role --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->uuid }}" 
                            {{ $user->roles->first() && $user->roles->first()->id == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success mt-2">Update</button>
        </form>
    </div>
</div>
@endsection
