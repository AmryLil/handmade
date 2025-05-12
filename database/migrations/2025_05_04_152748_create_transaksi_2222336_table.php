<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaksi_2222336', function (Blueprint $table) {
            $table->string('id_transaksi_2222336', 20)->primary();
            $table->string('id_pelanggan_2222336', 20);
            $table->foreign('id_pelanggan_2222336')->references('id_2222336')->on('users_2222336')->onDelete('cascade');
            $table->string('id_produk_2222336', 20);
            $table->foreign('id_produk_2222336')->references('id_2222336')->on('produk_2222336')->onDelete('cascade');
            $table->integer('jumlah_2222336');
            $table->decimal('harga_total_2222336', 10, 2);
            $table->enum('status_2222336', ['pending', 'dikemas', 'dikirim', 'selesai']);
            $table->string('bukti_tf_2222336');
            $table->timestamp('tanggal_transaksi_2222336')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_2222336');
    }
};
