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
        Schema::create('warning_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Warning::class)->constrained('warnings')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->text('message');
            $table->unique(['warning_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warning_translations');
    }
};
