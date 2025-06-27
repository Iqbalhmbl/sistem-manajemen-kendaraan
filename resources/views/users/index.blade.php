@extends('layouts.app')

@section('content')
<div class="card bg-dark text-white border-0 shadow-lg">
    <div class="card-header d-flex justify-content-between align-items-center bg-secondary text-white rounded-top-4">
        <span>User Accounts</span>
    </div>
    <div class="card-body">
        <a href="{{ route('users.create') }}" class="btn btn-sm btn-success mb-2">
            + Add User
        </a>
        <div class="p-1">
            <form method="GET" class="mb-3 d-flex gap-2">
                <input type="text" name="search" class="form-control bg-secondary text-white border-secondary" placeholder="Search name or email..." value="{{ request('search') }}">
                
                <select name="sort_by" class="form-select bg-secondary text-white border-secondary">
                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="email" {{ request('sort_by') == 'email' ? 'selected' : '' }}>Email</option>
                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Created By</option>
                </select>
                
                <select name="order" class="form-select bg-secondary text-white border-secondary">
                    <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>ASC</option>
                    <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>DESC</option>
                </select>
            
                <button class="btn btn-secondary">Filter</button>
            </form>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-dark align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span>{{ $role->name }}</span>@if(!$loop->last), @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $users->links() }}
    </div>
</div>
@endsection
