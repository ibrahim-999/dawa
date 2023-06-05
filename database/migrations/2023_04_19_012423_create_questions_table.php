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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        /**
         * settings translation table
         */
        Schema::create('question_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Question::class)->constrained('questions')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->text('title');
            $table->unique(['question_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
        Schema::dropIfExists('question_translations');
    }
};
