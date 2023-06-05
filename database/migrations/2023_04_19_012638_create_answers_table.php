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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Question::class)->constrained('questions')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('answer_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Answer::class)->constrained('answers')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->text('title');
            $table->unique(['answer_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
        Schema::dropIfExists('answer_translations');
    }
};
