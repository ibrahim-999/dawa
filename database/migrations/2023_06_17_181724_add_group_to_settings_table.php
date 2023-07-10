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
        Schema::table('settings', function (Blueprint $table) {
            $table->integer('group')->default(1); // 1 => general , 2 => loyalty setting
            $table->boolean('is_fixed')->default(0); // 0 => has traanslation , 1 => without translation , has value
            $table->string('fixed_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['group', 'is_fixed', 'fixed_value']);
        });
    }
};
