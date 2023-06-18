<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notification_centers', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['email', 'broadcast', 'sms', 'all']);
            $table->enum('user_type', ['users', 'vendors', 'all']);
            $table->enum('sent_type', ['now', 'schedule'])->default('now');
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->enum('status', ['pending', 'send']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_centers');
    }
};
