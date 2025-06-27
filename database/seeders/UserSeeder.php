<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $admin = User::firstOrCreate([
            'email' => 'admin@admin.com',
        ], [
            'name' => 'Admin',
            'password' => bcrypt('admin1234'),
        ]);
        $admin->assignRole('admin');

        // Staff (Petugas Pendaftaran)
        $staff = User::firstOrCreate([
            'email' => 'staff@staff.com',
        ], [
            'name' => 'Approval',
            'password' => bcrypt('staff1234'),
        ]);
        $staff->assignRole('approval');

    }
}
