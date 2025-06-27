@extends('layouts.app')

@section('content')
<div class="card bg-dark text-white border-0 shadow-lg">
    <div class="card-header bg-secondary text-white">
        <h1 class="mb-0">Tambah Pemesanan Kendaraan</h1>
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

        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            </div>

            <div class="mb-3">
                <label for="kendaraan_id" class="form-label">Kendaraan</label>
                <select name="kendaraan_id" id="kendaraan_id" class="form-select bg-secondary text-white border-secondary" required>
                    <option value="">-- Pilih Kendaraan --</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ old('kendaraan_id') == $vehicle->id ? 'selected' : '' }}>
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
                        <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                            {{ $driver->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal_pesan" class="form-label">Tanggal Pesan</label>
                <input type="datetime-local" name="tanggal_pesan" id="tanggal_pesan" 
                    class="form-control bg-secondary text-white border-secondary" 
                    value="{{ old('tanggal_pesan', now()->format('Y-m-d\TH:i')) }}" required readonly>
            </div>


            <div class="mb-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="datetime-local" name="tanggal_mulai" id="tanggal_mulai" class="form-control bg-secondary text-white border-secondary" value="{{ old('tanggal_mulai') }}" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                <input type="datetime-local" name="tanggal_selesai" id="tanggal_selesai" class="form-control bg-secondary text-white border-secondary" value="{{ old('tanggal_selesai') }}" required>
            </div>

            <div class="mb-3">
                <label for="tujuan" class="form-label">Alamat Tujuan</label>
                <textarea name="tujuan" id="tujuan" class="form-control bg-secondary text-white border-secondary" rows="3" required>{{ old('tujuan') }}</textarea>
            </div>
            <input type="hidden" name="status" value="pending">
            {{-- <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select bg-secondary text-white border-secondary" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div> --}}

            <div class="mb-3">
                <label for="approver1_id" class="form-label">Approver 1</label>
                <select name="approver1_id" id="approver1_id" class="form-select bg-secondary text-white border-secondary" required>
                    <option value="">-- Pilih Approver 1 --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('approver1_id') == $user->id ? 'selected' : '' }}>
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
                        <option value="{{ $user->id }}" {{ old('approver2_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <hr>

            <h5>Data Pemakaian Kendaraan (Booking Usage)</h5>

            <div class="mb-3">
                <label for="tanggal_usage" class="form-label">Tanggal Pemakaian</label>
                <input type="date" name="tanggal_usage" id="tanggal_usage" class="form-control bg-secondary text-white border-secondary" value="{{ old('tanggal_usage') }}" required>
            </div>

            <div class="mb-3">
                <label for="km_awal" class="form-label">KM Awal</label>
                <input type="number" name="km_awal" id="km_awal" class="form-control bg-secondary text-white border-secondary" value="{{ old('km_awal') }}" min="0" required>
            </div>

            {{-- <div class="mb-3">
                <label for="km_akhir" class="form-label">KM Akhir</label>
                <input type="number" name="km_akhir" id="km_akhir" class="form-control bg-secondary text-white border-secondary" value="{{ old('km_akhir') }}" min="0" required>
            </div>

            <div class="mb-3">
                <label for="konsumsi_bbm" class="form-label">Konsumsi BBM (liter)</label>
                <input type="number" step="0.01" name="konsumsi_bbm" id="konsumsi_bbm" class="form-control bg-secondary text-white border-secondary" value="{{ old('konsumsi_bbm') }}" min="0" required>
            </div> --}}

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
