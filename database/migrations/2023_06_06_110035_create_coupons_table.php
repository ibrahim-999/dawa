<?php

use App\Domains\User\v1\Enums\DiscountTypeEnum;
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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('discount_type',[DiscountTypeEnum::AMOUNT->value,DiscountTypeEnum::PRECENTAGE->value]);
            $table->float('discount');
            $table->float('min_purchases');
            $table->float('max_discount')->nullable();
            $table->integer('num_uses_person');
            $table->integer('num_uses');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
