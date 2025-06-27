<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\KendaraanUsage;
use Illuminate\Http\Request;

class KendaraanUsageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'kendaraan', 'driver'])
            ->where('status', 'selesai')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('usages.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(KendaraanUsage $kendaraanUsage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KendaraanUsage $kendaraanUsage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KendaraanUsage $kendaraanUsage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KendaraanUsage $kendaraanUsage)
    {
        //
    }
}
