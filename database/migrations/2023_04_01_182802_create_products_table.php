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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Category::class,'category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignIdFor(\App\Models\Category::class,'sub_category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignIdFor(\App\Models\Category::class,'subset_category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignIdFor(\App\Models\Brand::class)->nullable()->constrained('brands')->nullOnDelete();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });

        /**
         * product translation table
         */
        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Product::class)->nullable()->constrained('products')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unique(['product_id', 'locale']);
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_translations');
    }
};
