@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-4 bg-dark text-white">
                <div class="card-header bg-dark text-white rounded-top-4">
                    <h4 class="mb-0">Selamat Datang di Sistem Manajemen Kendaraan</h4>
                </div>
                <div class="card-body">
                    <p class="fs-5">
                        Sistem ini dirancang untuk mempermudah pengelolaan kendaraan perusahaan tambang, mulai dari data kendaraan, driver, pemesanan, hingga monitoring pemakaian dan service.
                    </p>

                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item bg-dark text-white">
                            ✅ <strong>Data Kendaraan</strong> — Kelola informasi kendaraan, termasuk jenis, merk, dan status kendaraan.
                        </li>
                        <li class="list-group-item bg-dark text-white">
                            ✅ <strong>Data Driver</strong> — Kelola data sopir yang bertugas mengemudikan kendaraan.
                        </li>
                        <li class="list-group-item bg-dark text-white">
                            ✅ <strong>Pemesanan Kendaraan</strong> — Sistem pemesanan kendaraan dengan persetujuan berjenjang.
                        </li>
                        <li class="list-group-item bg-dark text-white">
                            ✅ <strong>Monitoring Pemakaian</strong> — Pantau konsumsi BBM, jadwal service, dan riwayat pemakaian kendaraan.
                        </li>
                        <li class="list-group-item bg-dark text-white">
                            ✅ <strong>Manajemen Role & Permission</strong> — Kelola hak akses pengguna untuk keamanan sistem.
                        </li>
                        <li class="list-group-item bg-dark text-white">
                            ✅ <strong>Log Aktivitas</strong> — Pantau aktivitas pengguna untuk transparansi dan akuntabilitas.
                        </li>
                    </ul>

                    <div class="alert alert-info">
                        💡 <strong>Tips:</strong> Gunakan sidebar di sebelah kiri untuk menavigasi fitur utama aplikasi.
                    </div>

                    <p class="mt-3 mb-0 text-muted">
                        Sistem ini dikembangkan untuk memastikan efisiensi dan kemudahan dalam pengelolaan kendaraan perusahaan. Jika Anda memiliki pertanyaan atau masukan, silakan hubungi administrator sistem.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
