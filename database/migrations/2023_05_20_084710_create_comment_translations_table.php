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
        Schema::create('comment_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Comment::class)->constrained('comments')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->text('title');
            $table->text('body');
            $table->unique(['comment_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_translations');
    }
};
