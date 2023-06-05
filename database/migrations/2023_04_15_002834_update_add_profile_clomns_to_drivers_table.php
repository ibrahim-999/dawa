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
        Schema::table('drivers', function (Blueprint $table) {
            $table->string('id_number','30')->nullable();
            $table->string('nationality', '30')->nullable();
            $table->foreignIdFor(\App\Models\City::class)->nullable()->constrained('cities')->nullOnDelete();
            $table->string('vehicle_type', '30')->nullable();
            $table->string('vehicle_brand', '30')->nullable();
            $table->string('vehicle_plate_number', '30')->nullable();
            $table->enum('payment_service', ['bank_account','stc_pay'])->nullable();
            $table->string('account_holder_name')->nullable(); 
            $table->string('iban_number')->nullable(); 
            $table->string('stc_number')->nullable(); 
            $table->tinyInteger('step')->default(1); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumns([
                'id_number',
                'nationality',
                'city_id',
                'vehicle_type',
                'vehicle_brand',
                'vehicle_plate_number',
                'payment_service',
                'account_holder_name',
                'iban_number',
                'stc_number',
                'step',
            ]);
        });
    }
};
