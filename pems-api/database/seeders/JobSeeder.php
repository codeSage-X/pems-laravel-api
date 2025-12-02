<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        Job::create([
            'title' => 'Pipeline Inspection',
            'type' => 'INSPECTION',
            'employee_id' => 1, // Chukwu Okonkwo
            'client_id' => 1,
            'equipment' => 'Pressure Gauge, Cleaner',
            'logistics' => 'Truck-001',
            'status' => 'IN_PROGRESS',
            'priority' => 'HIGH',
            'description' => 'Routine pipeline inspection at Shell facility',
            'scheduled_date' => now()->addDays(2),
        ]);

        Job::create([
            'title' => 'Equipment Maintenance',
            'type' => 'MAINTENANCE',
            'employee_id' => 2, // Zainab Muhammadu
            'client_id' => 2,
            'equipment' => 'Seal Kit, Pump',
            'logistics' => 'Car-002',
            'status' => 'PENDING',
            'priority' => 'MEDIUM',
            'description' => 'Scheduled maintenance for hydraulic equipment',
            'scheduled_date' => now()->addDays(5),
        ]);
    }
}