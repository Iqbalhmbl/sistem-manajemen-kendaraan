@extends('layouts.app')

@section('content')
<div class="card bg-dark text-white border-0 shadow-lg">
    <div class="card-header d-flex justify-content-between align-items-center bg-secondary text-white rounded-top-4">
        <span>Data Pemesanan Kendaraan</span>
        <a href="{{ route('bookings.create') }}" class="btn btn-sm btn-success">+ Tambah Pemesanan Kendaraan</a>
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

                            @if($booking->status === 'pending')
                                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            @endif

                            @if($booking->status === 'approved')
                                <!-- Tombol Selesai untuk buka modal -->
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#selesaiModal{{ $booking->id }}">
                                    Selesai
                                </button>

                                <!-- Modal Input km_akhir dan konsumsi_bbm -->
                                <div class="modal fade" id="selesaiModal{{ $booking->id }}" tabindex="-1" aria-labelledby="selesaiModalLabel{{ $booking->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('bookings.finish', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="selesaiModalLabel{{ $booking->id }}">Selesaikan Booking</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="km_akhir_{{ $booking->id }}" class="form-label">KM Akhir</label>
                                                <input type="number" name="km_akhir" id="km_akhir_{{ $booking->id }}" class="form-control bg-secondary text-white border-secondary" min="{{ $booking->bookingUsage->km_awal ?? 0 }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="konsumsi_bbm_{{ $booking->id }}" class="form-label">Konsumsi BBM (liter)</label>
                                                <input type="number" step="0.01" name="konsumsi_bbm" id="konsumsi_bbm_{{ $booking->id }}" class="form-control bg-secondary text-white border-secondary" min="0" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                        </div>
                                    </form>
                                </div>
                                </div>
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
