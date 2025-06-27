@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Permissions for Role: {{ $role->name }}</div>
    <div class="card-body">
        <form action="{{ route('roles.update', $role->uuid) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                @foreach($permissions as $permission)
                    <div class="form-check">
                        <input
                            type="checkbox"
                            name="permissions[]"
                            value="{{ $permission->uuid }}"
                            class="form-check-input"
                            id="perm-{{ $permission->id }}"
                            {{ $role->permissions->contains('uuid', $permission->uuid) ? 'checked' : '' }}
                        >
                        <label for="perm-{{ $permission->id }}" class="form-check-label">
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-success">Update Permissions</button>
        </form>
    </div>
</div>
@endsection
