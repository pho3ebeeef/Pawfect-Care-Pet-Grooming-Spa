<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Service;
use App\Models\Pet;
use App\Models\Appointment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // --- Users ---
        $client = User::create([
            'name' => 'Client User',
            'email' => 'client@example.com',
            'password' => Hash::make('secret123'),
            'role' => 'client',
        ]);

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('secret123'),
            'role' => 'admin',
        ]);

        $groomer = User::create([
            'name' => 'Groomer User',
            'email' => 'groomer@example.com',
            'password' => Hash::make('secret123'),
            'role' => 'groomer',
        ]);

        // --- Services ---
        $service1 = Service::create([
            'name' => 'Full Groom',
            'price' => 500,
        ]);

        $service2 = Service::create([
            'name' => 'Bath Only',
            'price' => 200,
        ]);

        // --- Pet ---
        $pet = Pet::create([
            'name' => 'Buddy',
            'species' => 'Dog',
            'client_id' => $client->id,
        ]);

        // --- Appointment ---
        Appointment::create([
            'client_id' => $client->id,
            'pet_id' => $pet->id,
            'service_id' => $service1->id,
            'appointment_date' => now()->addDay(),
            'status' => 'scheduled',
            'groomer_id' => $groomer->id,
        ]);
    }
}