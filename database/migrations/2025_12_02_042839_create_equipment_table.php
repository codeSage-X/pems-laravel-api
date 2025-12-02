<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['COMPRESSOR', 'PUMP', 'GAUGE', 'SEAL_KIT', 'CLEANER', 'TOOLS', 'OTHER'])->default('OTHER');
            $table->string('serial_number')->unique();
            $table->string('location')->nullable();
            $table->enum('status', ['OPERATIONAL', 'MAINTENANCE', 'OUT_OF_SERVICE', 'RETIRED'])->default('OPERATIONAL');
            $table->date('last_maintenance')->nullable();
            $table->date('next_maintenance')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};