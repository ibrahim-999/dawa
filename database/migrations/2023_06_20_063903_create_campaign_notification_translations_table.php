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
        Schema::create('camp_notification_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\CampNotification::class,'camp_notification_id')->constrained('camp_notifications')->cascadeOnDelete();
            $table->string('locale');
            $table->string('title');
            $table->string('subject')->nullable();
            $table->longText('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camp_notification_translations');
    }
};
