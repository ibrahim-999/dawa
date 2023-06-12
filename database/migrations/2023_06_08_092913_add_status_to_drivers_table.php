<?php

use App\Domains\Driver\v1\Enums\DriverStatusEnum;
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
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });
        Schema::table('drivers', function (Blueprint $table) {
            $table->enum('status',[DriverStatusEnum::UNDER_REVIEW->value, DriverStatusEnum::PENDING->value, DriverStatusEnum::APPROVED->value, DriverStatusEnum::REJECTED->value])->default(DriverStatusEnum::UNDER_REVIEW->value);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });
    }
};
