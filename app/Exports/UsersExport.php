<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromArray, WithHeadings
{
    protected $fields;

    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    public function array(): array
    {
        $users = User::with('roles')->get();

        return $users->map(function ($user) {
            $row = [];

            foreach ($this->fields as $field) {
                if ($field === 'roles') {
                    $row[$field] = $user->roles->pluck('name')->implode(', ');
                } else {
                    $row[$field] = $user->{$field};
                }
            }

            return $row;
        })->toArray();
    }

    public function headings(): array
    {
        return $this->fields;
    }
}
