@extends('layouts.app')

@section('content')
<div class="card bg-dark text-white border-0 shadow-lg">
    <div class="card-header bg-secondary text-white">
        Audit Log
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-dark align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Event</th>
                        <th>Model</th>
                        <th>IP Address</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($audits as $index => $audit)
                        <tr>
                            <td>{{ $index + $audits->firstItem() }}</td>
                            <td>{{ $audit->user?->name ?? 'System' }}</td>
                            <td>{{ $audit->event }}</td>
                            <td>{{ class_basename($audit->auditable_type) }}</td>
                            <td>{{ $audit->ip_address }}</td>
                            <td>{{ $audit->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No audit logs available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $audits->links() }}
    </div>
</div>
@endsection
