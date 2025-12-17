<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            // Core Grooming
            ['name' => 'Full Groom Package', 'price' => 1200.00, 'description' => 'Bath, haircut, nail trim, ear cleaning'],
            ['name' => 'Quick Bath & Brush', 'price' => 600.00, 'description' => 'Refresh between full grooms'],
            ['name' => 'Pawdicure', 'price' => 350.00, 'description' => 'Nail trim with paw balm massage'],

            // Specialty Spa
            ['name' => 'Deluxe Spa Treatment', 'price' => 1800.00, 'description' => 'Aromatherapy bath with coat conditioning'],
            ['name' => 'De-Shedding Treatment', 'price' => 950.00, 'description' => 'Coat thinning and brushing for heavy shedders'],
            ['name' => 'Sensitive Skin Care', 'price' => 1000.00, 'description' => 'Hypoallergenic shampoo with soothing rinse'],

            // Add-Ons
            ['name' => 'Teeth Brushing', 'price' => 250.00, 'description' => 'Gentle dental cleaning for fresh breath'],
            ['name' => 'Ear Cleaning', 'price' => 200.00, 'description' => 'Safe removal of wax and debris'],
            ['name' => 'Flea & Tick Treatment', 'price' => 500.00, 'description' => 'Protective rinse to eliminate pests'],
            ['name' => 'Bow or Bandana Styling', 'price' => 150.00, 'description' => 'Playful accessory for a polished look'],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(['name' => $service['name']], $service);
        }
    }
}