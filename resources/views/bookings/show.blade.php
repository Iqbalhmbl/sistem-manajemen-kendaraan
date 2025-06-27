@extends('layouts.app')

@section('content')
<div class="card bg-dark text-white border-0 shadow-lg">
    <div class="card-header bg-secondary text-white">
        <h1 class="mb-0">Detail Pemesanan Kendaraan</h1>
    </div>
    <div class="card-body">
        <p><strong>User:</strong> {{ $booking->user->name ?? '-' }}</p>
        <p><strong>Kendaraan:</strong> {{ $booking->kendaraan->nomor_polisi ?? '-' }} - {{ $booking->kendaraan->merk ?? '' }}</p>
        <p><strong>Driver:</strong> {{ $booking->driver->nama ?? '-' }}</p>
        <p><strong>Tanggal Pesan:</strong> {{ $booking->tanggal_pesan }}</p>
        <p><strong>Tanggal Mulai:</strong> {{ $booking->tanggal_mulai }}</p>
        <p><strong>Tanggal Selesai:</strong> {{ $booking->tanggal_selesai }}</p>
        <p><strong>Tujuan:</strong> {{ $booking->tujuan }}</p>
        <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
        <p><strong>Approver 1:</strong> {{ $booking->approver1->name ?? '-' }}</p>
        <p><strong>Approver 2:</strong> {{ $booking->approver2->name ?? '-' }}</p>
        <p><strong>Approved 1 At:</strong> {{ $booking->approved1_at ?? '-' }}</p>
        <p><strong>Approved 2 At:</strong> {{ $booking->approved2_at ?? '-' }}</p>
        <p><strong>Keterangan:</strong> {{ $booking->keterangan ?? '-' }}</p>

        <hr>

        <h5>Data Pemakaian Kendaraan (Booking Usage)</h5>
        @if($booking->bookingUsage)
            <p><strong>Tanggal Pemakaian:</strong> {{ $booking->bookingUsage->tanggal }}</p>
            <p><strong>KM Awal:</strong> {{ $booking->bookingUsage->km_awal }}</p>
            <p><strong>KM Akhir:</strong> {{ $booking->bookingUsage->km_akhir }}</p>
            <p><strong>Konsumsi BBM:</strong> {{ $booking->bookingUsage->konsumsi_bbm }} liter</p>
        @else
            <p>Tidak ada data pemakaian kendaraan.</p>
        @endif

<a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection
