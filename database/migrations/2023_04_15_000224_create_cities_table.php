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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        /**
         * brand translation table
         */
        Schema::create('city_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\City::class)->constrained('cities')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('title');
            $table->unique(['city_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
        Schema::dropIfExists('city_translations');
    }
};
