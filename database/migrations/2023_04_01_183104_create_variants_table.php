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
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(1);
            $table->foreignIdFor(\App\Models\Product::class)->constrained('products')->cascadeOnDelete();
            $table->double('price')->default(0);
            $table->string('currency')->default('SAR');
            $table->double('discount_percentage')->default(0);
            $table->timestamps();
        });
        /**
         * variant translation table
         */
        Schema::create('variant_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Variant::class)->constrained('variants')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('specifications')->nullable();
            $table->unique(['variant_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
        Schema::dropIfExists('variant_translations');
    }
};
