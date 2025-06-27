<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Booking;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();

        $bookings = Booking::with(['user', 'kendaraan', 'driver'])
            ->where(function ($query) use ($userId) {
                $query->where('approver1_id', $userId)
                    ->orWhere('approver2_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('approval.index', compact('bookings'));
    }
public function approve(Booking $booking)
{
    $userId = auth()->id();

    // Pastikan user adalah approver1 atau approver2 dan status masih pending
    if ($booking->status !== 'pending' || !in_array($userId, [$booking->approver1_id, $booking->approver2_id])) {
        return redirect()->route('approvals.index')->with('error', 'Anda tidak berhak melakukan aksi ini.');
    }

    $data = [];

    if ($userId == $booking->approver1_id && is_null($booking->approved1_at)) {
        $data['approved1_at'] = now();
    } elseif ($userId == $booking->approver2_id && is_null($booking->approved2_at)) {
        $data['approved2_at'] = now();
    } else {
        return redirect()->route('approvals.index')->with('error', 'Anda sudah melakukan approval.');
    }

    // Update tanggal approve yang sesuai
    $booking->update($data);

    // Jika kedua approval sudah ada, ubah status menjadi approved
    if ($booking->approved1_at && $booking->approved2_at) {
        $booking->update(['status' => 'approved']);
    }

    return redirect()->route('approvals.index')->with('success', 'Booking berhasil diapprove.');
}

public function reject(Booking $booking)
{
    $userId = auth()->id();

    // Pastikan user adalah approver1 atau approver2 dan status masih pending
    if ($booking->status !== 'pending' || !in_array($userId, [$booking->approver1_id, $booking->approver2_id])) {
        return redirect()->route('approvals.index')->with('error', 'Anda tidak berhak melakukan aksi ini.');
    }

    // Set status reject dan isi keterangan (bisa dikembangkan dengan form input keterangan)
    $booking->update([
        'status' => 'rejected',
        'keterangan' => 'Ditolak oleh ' . auth()->user()->name,
    ]);

    return redirect()->route('approvals.index')->with('success', 'Booking berhasil ditolak.');
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
    public function show(Approval $approval)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Approval $approval)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Approval $approval)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Approval $approval)
    {
        //
    }
}
