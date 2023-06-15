<?php

use App\Domains\User\v1\Enums\OfferProductTypeEnum;
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
        Schema::create('offer_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Offer::class)->constrained('offers')->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Variant::class)->constrained('variants')->cascadeOnDelete();
            $table->enum('type',[OfferProductTypeEnum::BUY->value, OfferProductTypeEnum::GET->value]); // 1 => buy    , 2 => get
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_variants');
    }
};
