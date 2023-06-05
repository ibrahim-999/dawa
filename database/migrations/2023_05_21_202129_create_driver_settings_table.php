<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('driver_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Driver::class)->constrained('drivers')->cascadeOnDelete();
            $table->boolean('is_available')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_settings');
    }
};
