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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Product::class)->constrained('products')->cascadeOnDelete();
            $table->tinyInteger('type');
            $table->timestamps();
        });

        Schema::create('attribute_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Attribute::class)->constrained('attributes')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['attribute_id', 'locale']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('attribute_translations');
    }
};
