<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\Kendaraan;
use App\Models\KendaraanUsage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'kendaraan', 'driver'])->orderBy('created_at', 'desc')->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    public function finish(Request $request, Booking $booking)
    {
        $request->validate([
            'km_akhir' => 'required|integer|min:' . ($booking->bookingUsage->km_awal ?? 0),
            'konsumsi_bbm' => 'required|numeric|min:0',
        ]);

        // Update kendaraan usage
        $bookingUsage = $booking->bookingUsage;
        if (!$bookingUsage) {
            return redirect()->back()->with('error', 'Data pemakaian kendaraan tidak ditemukan.');
        }

        $bookingUsage->update([
            'km_akhir' => $request->km_akhir,
            'konsumsi_bbm' => $request->konsumsi_bbm,
        ]);

        // Update status booking menjadi selesai
        $booking->update([
            'status' => 'selesai',
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil diselesaikan.');
    }


    public function create()
    {
        $users = User::role('approval')->get();
        $vehicles = Kendaraan::where('status', 'aktif')->get();
        $drivers = Driver::all();

        return view('bookings.create', compact('users', 'vehicles', 'drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'driver_id' => 'required|exists:drivers,id',
            'tanggal_pesan' => 'required|date',
            'tanggal_mulai' => 'required|date|after_or_equal:tanggal_pesan',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tujuan' => 'required|string',
            'status' => 'required|in:pending,approved,rejected,selesai',
            'approver1_id' => 'required|exists:users,id',
            'approver2_id' => 'required|exists:users,id',
            'approved1_at' => 'nullable|date',
            'approved2_at' => 'nullable|date',
            'keterangan' => 'nullable|string',

            // BookingUsage validation
            'tanggal_usage' => 'required|date',
            'km_awal' => 'required|integer|min:0',
            // 'km_akhir' => 'required|integer|min:0|gte:km_awal',
            // 'konsumsi_bbm' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $booking = Booking::create([
                'user_id' => $request->user_id,
                'kendaraan_id' => $request->kendaraan_id,
                'driver_id' => $request->driver_id,
                'tanggal_pesan' => $request->tanggal_pesan,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'tujuan' => $request->tujuan,
                'status' => $request->status,
                'approver1_id' => $request->approver1_id,
                'approver2_id' => $request->approver2_id,
                'approved1_at' => $request->approved1_at,
                'approved2_at' => $request->approved2_at,
                'keterangan' => $request->keterangan,
            ]);

            KendaraanUsage::create([
                'kendaraan_id' => $request->kendaraan_id,
                'booking_id' => $booking->id,
                'tanggal' => $request->tanggal_usage,
                'km_awal' => $request->km_awal,
                'km_akhir' => 0,
                'konsumsi_bbm' => 0,
            ]);
        });

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibuat beserta data penggunaan kendaraan.');
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'kendaraan', 'driver', 'bookingUsage']);
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $users = User::role('approval')->get();
        $vehicles = Kendaraan::where('status', 'aktif')->get();
        $drivers = Driver::all();
        $bookingUsage = $booking->bookingUsage;

        return view('bookings.edit', compact('booking', 'users', 'vehicles', 'drivers','bookingUsage'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'driver_id' => 'required|exists:drivers,id',
            'tanggal_pesan' => 'required|date',
            'tanggal_mulai' => 'required|date|after_or_equal:tanggal_pesan',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tujuan' => 'required|string',
            'status' => 'required|in:pending,approved,rejected,selesai',
            'approver1_id' => 'required|exists:users,id',
            'approver2_id' => 'required|exists:users,id',
            'approved1_at' => 'nullable|date',
            'approved2_at' => 'nullable|date',
            'keterangan' => 'nullable|string',

            // BookingUsage validation
            'tanggal_usage' => 'required|date',
            'km_awal' => 'required|integer|min:0',
            // 'km_akhir' => 'nullable|integer|min:0|gte:km_awal',
            // 'konsumsi_bbm' => 'nullable|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $booking) {
            $booking->update([
                'user_id' => $request->user_id,
                'kendaraan_id' => $request->kendaraan_id,
                'driver_id' => $request->driver_id,
                'tanggal_pesan' => $request->tanggal_pesan,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'tujuan' => $request->tujuan,
                'status' => $request->status,
                'approver1_id' => $request->approver1_id,
                'approver2_id' => $request->approver2_id,
                'approved1_at' => $request->approved1_at,
                'approved2_at' => $request->approved2_at,
                'keterangan' => $request->keterangan,
            ]);

            if ($booking->bookingUsage) {
                $booking->bookingUsage->update([
                    'kendaraan_id' => $request->kendaraan_id,
                    'tanggal' => $request->tanggal_usage,
                    'km_awal' => $request->km_awal,
                    'km_akhir' => 0,
                    'konsumsi_bbm' => 0,
                ]);
            } else {
                KendaraanUsage::create([
                    'kendaraan_id' => $request->kendaraan_id,
                    'booking_id' => $booking->id,
                    'tanggal' => $request->tanggal_usage,
                    'km_awal' => $request->km_awal,
                    'km_akhir' => 0,
                    'konsumsi_bbm' => 0,
                ]);
            }
        });

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil diperbarui.');
    }


    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dihapus.');
    }
}
