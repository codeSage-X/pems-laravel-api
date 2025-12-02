<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipment;

class EquipmentSeeder extends Seeder
{
    public function run(): void
    {
        Equipment::create([
            'name' => 'Compressor Unit A',
            'type' => 'COMPRESSOR',
            'serial_number' => 'CMP-001',
            'location' => 'Rig 1',
            'status' => 'OPERATIONAL',
            'last_maintenance' => '2024-11-15',
            'next_maintenance' => '2025-02-15',
        ]);

        Equipment::create([
            'name' => 'Pressure Gauge',
            'type' => 'GAUGE',
            'serial_number' => 'GAU-001',
            'location' => 'Warehouse A',
            'status' => 'OPERATIONAL',
            'last_maintenance' => '2024-10-20',
            'next_maintenance' => '2025-01-20',
        ]);

        Equipment::create([
            'name' => 'Seal Kit Industrial',
            'type' => 'SEAL_KIT',
            'serial_number' => 'SEK-001',
            'location' => 'Storage Room 2',
            'status' => 'OPERATIONAL',
            'last_maintenance' => null,
        ]);

        Equipment::create([
            'name' => 'Hydraulic Pump',
            'type' => 'PUMP',
            'serial_number' => 'PMP-001',
            'location' => 'Rig 2',
            'status' => 'MAINTENANCE',
            'last_maintenance' => '2024-11-01',
            'next_maintenance' => '2024-12-15',
        ]);
    }
}