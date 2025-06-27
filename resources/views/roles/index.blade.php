@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Role - Permission Management</div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $index => $role)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        @foreach($role->permissions as $perm)
                            <span class="badge bg-info">{{ $perm->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        @can('edit-role')
                        <a href="{{ route('roles.edit', $role->uuid) }}" class="btn btn-sm btn-primary">
                            Edit
                        </a>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $roles->links() }}
    </div>
</div>
@endsection
