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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('discount_type',[DiscountTypeEnum::AMOUNT->value,DiscountTypeEnum::PRECENTAGE->value]);
            $table->float('discount');
            $table->integer('get_amount');
            $table->integer('buy_amount');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('offer_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Offer::class)->constrained('offers')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->text('title');
            $table->text('description');
            $table->unique(['offer_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
        Schema::dropIfExists('offer_translations');
    }
};
