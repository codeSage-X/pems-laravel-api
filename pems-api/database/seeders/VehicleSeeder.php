<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        Vehicle::create([
            'name' => 'Truck-001',
            'type' => 'CARGO_TRUCK',
            'license_plate' => 'GPS-2024-001',
            'fuel_level' => 45,
            'mileage' => 12500,
            'status' => 'IN_TRANSIT',
            'last_inspection' => '2024-11-15',
            'next_inspection' => '2025-05-15',
        ]);

        Vehicle::create([
            'name' => 'Car-002',
            'type' => 'CAR',
            'license_plate' => 'GPS-2024-002',
            'fuel_level' => 80,
            'mileage' => 8200,
            'status' => 'AVAILABLE',
            'last_inspection' => '2024-10-20',
            'next_inspection' => '2025-04-20',
        ]);

        Vehicle::create([
            'name' => 'Van-003',
            'type' => 'VAN',
            'license_plate' => 'GPS-2024-003',
            'fuel_level' => 60,
            'mileage' => 15300,
            'status' => 'AVAILABLE',
            'last_inspection' => '2024-09-10',
            'next_inspection' => '2025-03-10',
        ]);
    }
}