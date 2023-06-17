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
        Schema::create('notification_center_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\NotificationCenter::class)->constrained('notification_centers')->cascadeOnDelete();
            $table->string('locale');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('subject')->nullable();
//            $table->unique(['category_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_center_translations');
    }
};
