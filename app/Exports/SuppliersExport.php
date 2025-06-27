<?php
namespace App\Exports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SuppliersExport implements FromCollection, WithHeadings
{
    protected $fields;

    public function __construct($filters = [])
    {
        $this->fields = $filters['fields'] ?? ['name', 'phone', 'website'];
    }

    public function collection()
    {
        $suppliers = Supplier::all();
    
        return $suppliers->map(function ($supplier) {
            $row = [];
    
            foreach ($this->fields as $field) {
                if ($field === 'address') {
                    $address = $supplier->address ?? [];
                    $row['street'] = $address['street'] ?? '';
                    $row['city'] = $address['city'] ?? '';
                    $row['province'] = $address['province'] ?? '';
                    $row['postal_code'] = $address['postal_code'] ?? '';
                } elseif ($field === 'contact_person') {
                    $contact = $supplier->contact_person ?? [];
                    $row['contact_name'] = $contact['name'] ?? '';
                    $row['contact_phone'] = $contact['phone'] ?? '';
                    $row['contact_position'] = $contact['position'] ?? '';
                } else {
                    $row[$field] = $supplier->{$field};
                }
            }
    
            return $row;
        });
    }
    
    public function headings(): array
    {
        $headings = [];
    
        foreach ($this->fields as $field) {
            if ($field === 'address') {
                $headings[] = 'Street';
                $headings[] = 'City';
                $headings[] = 'Province';
                $headings[] = 'Postal Code';
            } elseif ($field === 'contact_person') {
                $headings[] = 'Contact Name';
                $headings[] = 'Contact Phone';
                $headings[] = 'Contact Position';
            } else {
                $headings[] = ucfirst(str_replace('_', ' ', $field));
            }
        }
    
        return $headings;
    }
    
}


