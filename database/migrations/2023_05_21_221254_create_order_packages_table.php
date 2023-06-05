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
        Schema::create('order_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Order::class)->constrained('orders')->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Variant::class)->constrained('variants')->cascadeOnDelete();
            $table->integer('quantity')->nullable();
            $table->foreignIdFor(\App\Models\Vendor::class)->nullable()->constrained('vendors')->nullOnDelete();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_packages');
    }
};
