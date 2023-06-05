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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->nullable();
            $table->foreignIdFor(\App\Models\Driver::class)->nullable()->constrained('drivers')->nullOnDelete();
            $table->foreignIdFor(\App\Models\User::class)->nullable()->constrained('users')->nullOnDelete();
            $table->foreignIdFor(\App\Models\Address::class)->nullable()->constrained('addresses')->nullOnDelete();
            $table->foreignIdFor(\App\Models\Cart::class)->nullable()->constrained('carts')->nullOnDelete();
            $table->tinyInteger('delivery_type')->nullable();
            $table->timestamp('schedule_date')->nullable();
            $table->string('schedule_time')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('type')->nullable();
            $table->boolean('accept_alternatives')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
