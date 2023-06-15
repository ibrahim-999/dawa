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
        Schema::create('cart_variant', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Cart::class)->constrained('carts')->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Variant::class)->constrained('variants')->cascadeOnDelete();
            $table->integer('quantity')->nullable();
            $table->double('initial_price')->nullable();
            $table->boolean('is_modified')->default(0);
            $table->tinyInteger('modification_type')->nullable();
            $table->string('modification_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_variant');
    }
};
