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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->timestamps();
        });

        /**
         * settings translation table
         */
        Schema::create('setting_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Setting::class)->constrained('settings')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->longText('value');
            $table->unique(['setting_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('setting_translations');
    }
};
