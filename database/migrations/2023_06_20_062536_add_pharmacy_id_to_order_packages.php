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
        Schema::table('order_packages', function (Blueprint $table) {
            $table->dropForeign('order_packages_vendor_id_foreign');
            $table->dropColumn('vendor_id');
            $table->foreignIdFor(\App\Models\Pharmacy::class)->nullable()->constrained('pharmacies')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_packages', function (Blueprint $table) {
            //
        });
    }
};
