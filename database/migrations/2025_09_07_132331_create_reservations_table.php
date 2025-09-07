<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->decimal('service_fee_usd', 10, 2)->default(0);
            $table->decimal('total_usd', 10, 2)->default(0);
            $table->decimal('usd_to_try_rate', 10, 4)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
