<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        Client::create([
            'name' => 'Shell Petroleum Development Company',
            'code' => 'SPDC',
            'industry' => 'Oil & Gas',
            'email' => 'contact@shell.com.ng',
            'phone' => '+234 1 234 5678',
            'address' => 'Plot 1, Industry Road, Lagos',
            'status' => 'ACTIVE',
        ]);

        Client::create([
            'name' => 'Chevron Nigeria Limited',
            'code' => 'CNL',
            'industry' => 'Oil & Gas',
            'email' => 'info@chevron.com.ng',
            'phone' => '+234 1 345 6789',
            'address' => 'Chevron Drive, Lekki, Lagos',
            'status' => 'ACTIVE',
        ]);

        Client::create([
            'name' => 'TotalEnergies Nigeria',
            'code' => 'TEN',
            'industry' => 'Oil & Gas',
            'email' => 'contact@totalenergies.ng',
            'phone' => '+234 1 456 7890',
            'address' => 'Total Tower, Victoria Island, Lagos',
            'status' => 'ACTIVE',
        ]);
    }
}