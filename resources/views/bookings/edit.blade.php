@extends('layouts.app')

@section('content')
<div class="card bg-dark text-white border-0 shadow-lg">
    <div class="card-header bg-secondary text-white">
        <h1 class="mb-0">Edit Pemesanan Kendaraan</h1>
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

        <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <input type="hidden" name="user_id" value="{{ $booking->user_id }}">
            </div>

            <div class="mb-3">
                <label for="kendaraan_id" class="form-label">Kendaraan</label>
                <select name="kendaraan_id" id="kendaraan_id" class="form-select bg-secondary text-white border-secondary" required>
                    <option value="">-- Pilih Kendaraan --</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ old('kendaraan_id', $booking->kendaraan_id) == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->nomor_polisi }} - {{ $vehicle->merk }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="driver_id" class="form-label">Driver</label>
                <select name="driver_id" id="driver_id" class="form-select bg-secondary text-white border-secondary" required>
                    <option value="">-- Pilih Driver --</option>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}" {{ old('driver_id', $booking->driver_id) == $driver->id ? 'selected' : '' }}>
                            {{ $driver->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal_pesan" class="form-label">Tanggal Pesan</label>
                <input type="datetime-local" name="tanggal_pesan" id="tanggal_pesan" 
                    class="form-control bg-secondary text-white border-secondary" 
                    value="{{ old('tanggal_pesan', \Carbon\Carbon::parse($booking->tanggal_pesan)->format('Y-m-d\TH:i')) }}" required readonly>
            </div>

            <div class="mb-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="datetime-local" name="tanggal_mulai" id="tanggal_mulai" class="form-control bg-secondary text-white border-secondary" value="{{ old('tanggal_mulai', \Carbon\Carbon::parse($booking->tanggal_mulai)->format('Y-m-d\TH:i')) }}" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                <input type="datetime-local" name="tanggal_selesai" id="tanggal_selesai" class="form-control bg-secondary text-white border-secondary" value="{{ old('tanggal_selesai', \Carbon\Carbon::parse($booking->tanggal_selesai)->format('Y-m-d\TH:i')) }}" required>
            </div>

            <div class="mb-3">
                <label for="tujuan" class="form-label">Alamat Tujuan</label>
                <textarea name="tujuan" id="tujuan" class="form-control bg-secondary text-white border-secondary" rows="3" required>{{ old('tujuan', $booking->tujuan) }}</textarea>
            </div>

            <input type="hidden" name="status" value="{{ $booking->status }}">

            <div class="mb-3">
                <label for="approver1_id" class="form-label">Approver 1</label>
                <select name="approver1_id" id="approver1_id" class="form-select bg-secondary text-white border-secondary" required>
                    <option value="">-- Pilih Approver 1 --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('approver1_id', $booking->approver1_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="approver2_id" class="form-label">Approver 2</label>
                <select name="approver2_id" id="approver2_id" class="form-select bg-secondary text-white border-secondary" required>
                    <option value="">-- Pilih Approver 2 --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('approver2_id', $booking->approver2_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <hr>

            <h5>Data Pemakaian Kendaraan (Booking Usage)</h5>

            <div class="mb-3">
                <label for="tanggal_usage" class="form-label">Tanggal Pemakaian</label>
                <input type="date" name="tanggal_usage" id="tanggal_usage" class="form-control bg-secondary text-white border-secondary" value="{{ old('tanggal_usage', $bookingUsage->tanggal ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="km_awal" class="form-label">KM Awal {{$bookingUsage->km_awal}}</label>
                <input type="number" name="km_awal" id="km_awal" class="form-control bg-secondary text-white border-secondary" value="{{ old('km_awal', $bookingUsage->km_awal ?? '') }}" min="0" required>
            </div>

            {{-- Jika ingin menampilkan dan edit km_akhir dan konsumsi_bbm, bisa tambahkan disini --}}

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
