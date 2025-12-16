<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Branch Store User
        $branch = User::firstOrCreate(
            ['email' => 'branch@cps.com'],
            [
                'name' => 'Branch Manager',
                'password' => Hash::make('password'),
            ]
        );
        $branch->assignRole('Branch Store');

        // Supplier User
        $supplier = User::firstOrCreate(
            ['email' => 'supplier@cps.com'],
            [
                'name' => 'Supplier Admin',
                'password' => Hash::make('password'),
            ]
        );
        $supplier->assignRole('Supplier');

        // Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@cps.com'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('Admin');
    }
}
