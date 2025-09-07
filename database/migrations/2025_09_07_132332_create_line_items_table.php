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
        Schema::create('line_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['otel', 'ucak', 'transfer', 'sigorta', 'esim']);
            $table->foreignId('supplier_id')->nullable()->constrained()->onDelete('set null');
            $table->string('title'); // Otel adı, havayolu vs.
            $table->date('start_date')->nullable(); // Giriş / kalkış vs.
            $table->date('end_date')->nullable();   // Çıkış / dönüş vs.
            $table->decimal('price_usd', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_items');
    }
};
