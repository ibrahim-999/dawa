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
        Schema::create('firebase_device_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('device_id', 255)->nullable();
            $table->string('device_token', 255);
            $table->enum('device_type',['android','ios','web']);
            $table->nullableMorphs('notifiable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firebase_device_tokens');
    }
};
