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
        Schema::create('campaign_notification_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\CampaignNotification::class,'camp_notification_id')->constrained('campaign_notifications')->cascadeOnDelete();
            $table->string('locale');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->text('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_notification_translations');
    }
};
