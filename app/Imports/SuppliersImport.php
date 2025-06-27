<?php
namespace App\Imports;

use App\Models\Supplier;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SuppliersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Supplier([
            'name' => $row['name'],
            'phone' => $row['phone'],
            'website' => $row['website'] ?? null,
            'npwp' => $row['npwp'] ?? null,
            'notes' => $row['notes'] ?? null,
            'contact_person' => [
                'name' => $row['contact_name'] ?? null,
                'phone' => $row['contact_phone'] ?? null,
                'position' => $row['contact_position'] ?? null,
            ],
            'address' => [
                'street' => $row['street'] ?? null,
                'city' => $row['city'] ?? null,
                'province' => $row['province'] ?? null,
                'postal_code' => $row['postal_code'] ?? null,
            ],
        ]);
    }
}
