<?php
namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookingExport implements FromCollection, WithHeadings, WithMapping
{
    protected $start;
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function collection()
    {
        return Booking::with(['user', 'kendaraan', 'driver'])
            ->whereBetween('tanggal_pesan', [$this->start, $this->end])
            ->orderBy('tanggal_pesan', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'User',
            'Kendaraan',
            'Driver',
            'Tanggal Pesan',
            'Status',
        ];
    }

    public function map($booking): array
    {
        static $no = 1;
        return [
            $no++,
            $booking->user->name ?? '-',
            $booking->kendaraan->nomor_polisi ?? '-',
            $booking->driver->nama ?? '-',
            $booking->tanggal_pesan,
            ucfirst($booking->status),
        ];
    }
}
