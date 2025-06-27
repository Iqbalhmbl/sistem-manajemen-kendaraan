<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\KendaraanUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\BookingExport;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Ambil total konsumsi BBM per kendaraan (nomor polisi)
        $data = KendaraanUsage::select('kendaraan_id', DB::raw('SUM(konsumsi_bbm) as total_bbm'))
            ->groupBy('kendaraan_id')
            ->with('kendaraan') // relasi ke kendaraan
            ->get();

        // Siapkan data untuk chart
        $labels = $data->map(fn($item) => $item->kendaraan->nomor_polisi ?? 'Unknown')->toArray();
        $values = $data->pluck('total_bbm')->toArray();

        return view('home', compact('labels', 'values'));
    }

    public function laporan(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');

        $query = Booking::with(['user', 'kendaraan', 'driver'])->orderBy('created_at', 'desc');

        if ($start && $end) {
            $query->whereBetween('tanggal_pesan', [$start, $end]);
        }

        $bookings = $query->paginate(10);

        return view('laporan.index', compact('bookings', 'start', 'end'));
    }

    public function exportExcel(Request $request)
    {
        $start = $request->input('start') ?? now()->startOfMonth()->toDateString();
        $end = $request->input('end') ?? now()->endOfMonth()->toDateString();

        return Excel::download(new BookingExport($start, $end), 'laporan_pemesanan_kendaraan.xlsx');
    }
}
