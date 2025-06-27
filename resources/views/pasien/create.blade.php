@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Tambah Pasien</div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('pasien.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="wilayah_id" class="form-label">Wilayah</label>
                <select name="wilayah_id" class="form-select" required>
                    <option value="">-- Pilih Wilayah --</option>
                    @foreach($wilayahs as $wilayah)
                        <option value="{{ $wilayah->id }}" {{ old('wilayah_id') == $wilayah->id ? 'selected' : '' }}>
                            {{ $wilayah->nama_wilayah }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kunjungan" class="form-label">Jenis Kunjungan</label>
                <select name="jenis_kunjungan" class="form-select" required>
                    <option value="">-- Pilih Jenis Kunjungan --</option>
                    @php
                        $jenisList = [
                            'umum' => 'Umum - Konsultasi dengan dokter umum',
                            'BPJS' => 'BPJS - Kunjungan yang ditanggung oleh BPJS Kesehatan',
                            'gigi' => 'Gigi - Pemeriksaan atau tindakan oleh dokter gigi',
                            'KIA' => 'KIA (Kesehatan Ibu dan Anak) - Pemeriksaan kehamilan, bayi, balita, dan imunisasi',
                            'lansia' => 'Lansia - Layanan kesehatan khusus lansia',
                            'vaksinasi' => 'Vaksinasi / Imunisasi - Kunjungan untuk pemberian vaksin',
                            'laboratorium' => 'Laboratorium - Pemeriksaan penunjang seperti darah, urin, dsb',
                            'kunjungan_ulang' => 'Kunjungan Ulang / Kontrol - Tindak lanjut dari kunjungan sebelumnya',
                            'darurat' => 'Kunjungan Darurat / Gawat Darurat - Untuk kondisi mendesak',
                            'pemeriksaan_khusus' => 'Pemeriksaan Khusus - Misalnya EKG, USG, Pap Smear, dsb',
                            'rawat_luka' => 'Rawat Luka - Perawatan luka ringan hingga sedang',
                            'narkoba' => 'Pemeriksaan Narkoba - Tes urin atau darah untuk skrining narkoba',
                            'psikologi' => 'Konsultasi Psikologi - Layanan untuk kesehatan mental',
                        ];
                    @endphp
                    @foreach($jenisList as $key => $label)
                        <option value="{{ $key }}" {{ old('jenis_kunjungan') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_kunjungan" class="form-label">Tanggal Kunjungan</label>
                <input type="date" name="tanggal_kunjungan" class="form-control" value="{{ old('tanggal_kunjungan') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
