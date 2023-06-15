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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * brand translation table
         */
        Schema::create('slider_translations', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignIdFor(\App\Models\Slider::class)
                ->constrained('sliders')
                ->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('title');
            $table->unique(['slider_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
        Schema::dropIfExists('slider_translations');
    }
};
