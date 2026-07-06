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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Data Pengiriman
            $table->string('recipient_name');
            $table->string('recipient_phone');
            $table->text('address_note')->nullable(); // Patokan Lokasi
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->decimal('distance_km', 5, 2)->nullable(); // Jarak dari toko

            // Finansial
            $table->decimal('subtotal', 12, 2); // Harga total barang
            $table->decimal('shipping_fee', 12, 2); // Rp 15.000 atau Rp 0
            $table->decimal('grand_total', 12, 2); // Subtotal + Shipping

            // Pembayaran & Status
            $table->enum('payment_method', ['transfer', 'cod']);
            $table->enum('status', ['pending', 'diproses', 'dikirim', 'selesai', 'tertunda', 'dibatalkan'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
