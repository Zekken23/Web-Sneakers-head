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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel orders
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');

            // Relasi ke tabel sneakers (Barang apa yang dibeli?)
            $table->foreignId('sneaker_id')->constrained('sneakers')->onDelete('cascade');

            $table->string('sneaker_name'); // Simpan nama saat beli (jaga2 kalau nama asli berubah)
            $table->integer('quantity');
            $table->decimal('price', 15, 2); // Simpan harga saat beli (jaga2 kalau harga asli naik)
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
