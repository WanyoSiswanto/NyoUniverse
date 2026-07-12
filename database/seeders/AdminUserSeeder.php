<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'username' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@nyouniverse.local',
            'password' => Hash::make('admin123'),
            'department' => 'IT',
            'status' => 'active',
        ]);

        $admin->assignRole('admin');

        // Create manager user
        $manager = User::create([
            'username' => 'manager',
            'name' => 'Manager',
            'email' => 'manager@nyouniverse.local',
            'password' => Hash::make('manager123'),
            'department' => 'QA',
            'status' => 'active',
        ]);

        $manager->assignRole('manager');
    }
}
