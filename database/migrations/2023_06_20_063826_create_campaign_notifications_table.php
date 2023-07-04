<?php

use App\Domains\Campaigns\v1\Enums\CampaignSentTypeEnum;
use App\Domains\Campaigns\v1\Enums\CampaignTypeEnum;
use App\Domains\Campaigns\v1\Enums\CampaignUserTypeEnum;
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
        Schema::create('camp_notifications', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->default(CampaignTypeEnum::ALL->value)->nullable();
            $table->tinyInteger('user_type')->default(CampaignUserTypeEnum::ALL->value)->nullable();
            $table->tinyInteger('sent_type')->default(CampaignSentTypeEnum::NOW->value)->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camp_notifications');
    }
};
