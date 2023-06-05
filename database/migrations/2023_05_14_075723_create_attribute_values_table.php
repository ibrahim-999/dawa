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
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Attribute::class)->constrained('attributes')->cascadeOnDelete();
            $table->string('code')->nullable();
            $table->timestamps();
        });
        Schema::create('attribute_value_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\AttributeValue::class)->constrained('attribute_values')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['attribute_value_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_values');
        Schema::dropIfExists('attribute_value_values');
    }
};
