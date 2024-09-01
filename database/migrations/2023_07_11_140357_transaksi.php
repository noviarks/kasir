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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->date('tanggal');
            $table->bigInteger('subtotal_diskon');
            $table->bigInteger('subtotal_harga');
            $table->bigInteger('total_bayar');
            $table->bigInteger('pembayaran');
            $table->bigInteger('kembalian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
