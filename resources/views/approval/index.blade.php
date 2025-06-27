@extends('layouts.app')

@section('content')
<div class="card bg-dark text-white border-0 shadow-lg">
    <div class="card-header d-flex justify-content-between align-items-center bg-secondary text-white rounded-top-4">
        <span>Data Bookings</span>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-dark align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Kendaraan</th>
                        <th>Driver</th>
                        <th>Tanggal Pesan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $index => $booking)
                    <tr>
                        <td>{{ $bookings->firstItem() + $index }}</td>
                        <td>{{ $booking->user->name ?? '-' }}</td>
                        <td>{{ $booking->kendaraan->nomor_polisi ?? '-' }}</td>
                        <td>{{ $booking->driver->nama ?? '-' }}</td>
                        <td>{{ $booking->tanggal_pesan }}</td>
                        <td>{{ ucfirst($booking->status) }}</td>
                    <td>
                        <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info btn-sm">Detail</a>

                        @if($booking->status === 'pending' && (auth()->id() == $booking->approver1_id || auth()->id() == $booking->approver2_id))
                            {{-- Cek apakah user sudah approve --}}
                            @php
                                $alreadyApproved = false;
                                if(auth()->id() == $booking->approver1_id && $booking->approved1_at) {
                                    $alreadyApproved = true;
                                }
                                if(auth()->id() == $booking->approver2_id && $booking->approved2_at) {
                                    $alreadyApproved = true;
                                }
                            @endphp

                            @if(!$alreadyApproved)
                                <form action="{{ route('bookings.approve', $booking->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Setujui booking ini?')">Approve</button>
                                </form>

                                <form action="{{ route('bookings.reject', $booking->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tolak booking ini?')">Reject</button>
                                </form>
                            @endif
                        @endif
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $bookings->links() }}
    </div>
</div>
@endsection
