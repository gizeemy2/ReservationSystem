<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Eğer daha önce yoksa aşağıdaki alanları ekle

            $table->integer('guest_count')->default(1)->after('customer_id');
            $table->enum('segment', ['GZM PREMIUM', 'GZM STANDART'])->nullable()->after('guest_count');

            $table->string('passport_no')->nullable()->after('segment');
            $table->string('country')->nullable()->after('passport_no');

            // 🏨 Otel Bilgileri
            $table->string('hotel_name')->nullable()->after('country');
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->integer('night_count')->nullable();
            $table->string('room_type')->nullable();
            $table->decimal('hotel_price', 10, 2)->nullable();
            $table->string('hotel_supplier')->nullable();
            $table->text('hotel_note')->nullable();

            // ✈️ Uçak Bilgileri
            $table->dateTime('flight_departure')->nullable();
            $table->dateTime('flight_return')->nullable();
            $table->string('airline')->nullable();
            $table->string('pnr')->nullable();
            $table->string('baggage')->nullable();
            $table->decimal('flight_price', 10, 2)->nullable();
            $table->string('flight_supplier')->nullable();

            // 🚐 Transfer
            $table->dateTime('transfer_date')->nullable();
            $table->enum('transfer_direction', ['Gidiş', 'Dönüş'])->nullable();
            $table->decimal('transfer_price', 10, 2)->nullable();
            $table->string('transfer_supplier')->nullable();

            // 🛡️ Sigorta
            $table->string('insurance_type')->nullable();
            $table->decimal('insurance_price', 10, 2)->nullable();
            $table->string('insurance_supplier')->nullable();

            // 📱 eSIM
            $table->string('esim_package')->nullable();
            $table->decimal('esim_price', 10, 2)->nullable();
            $table->string('esim_supplier')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->dropColumn([
            'customer_id', 'guest_count', 'segment', 'passport_no', 'country',
            'hotel_name', 'check_in', 'check_out', 'night_count', 'room_type', 'hotel_price', 'hotel_supplier', 'hotel_note',
            'flight_departure', 'flight_return', 'airline', 'pnr', 'baggage', 'flight_price', 'flight_supplier',
            'transfer_date', 'transfer_direction', 'transfer_price', 'transfer_supplier',
            'insurance_type', 'insurance_price', 'insurance_supplier',
            'esim_package', 'esim_price', 'esim_supplier',
        ]);
    }
};
