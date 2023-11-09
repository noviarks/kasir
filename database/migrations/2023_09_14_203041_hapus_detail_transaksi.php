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
        Schema::create('hapus_detail_transaksi', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('id_transaksi');
            $table->string('id_barang');
            $table->integer('qty');
            $table->integer('diskon');
            $table->bigInteger('harga');
            $table->bigInteger('total_diskon');
            $table->bigInteger('total_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
