<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Truck-001
            $table->enum('type', ['CARGO_TRUCK', 'VAN', 'CAR', 'PICKUP'])->default('CARGO_TRUCK');
            $table->string('license_plate')->unique();
            $table->integer('fuel_level')->default(100); // Percentage 0-100
            $table->integer('mileage')->default(0); // In kilometers
            $table->enum('status', ['AVAILABLE', 'IN_TRANSIT', 'MAINTENANCE', 'OUT_OF_SERVICE'])->default('AVAILABLE');
            $table->date('last_inspection')->nullable();
            $table->date('next_inspection')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};