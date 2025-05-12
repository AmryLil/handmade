<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('produk_2222336', function (Blueprint $table) {
            $table->string('id_2222336', 20)->primary();
            $table->string('nama_2222336');
            $table->text('deskripsi_2222336');
            $table->decimal('harga_2222336', 10, 2);
            $table->string('kategori_id_2222336', 20);
            $table->foreign('kategori_id_2222336')->references('id_2222336')->on('kategori_produk_2222336')->onDelete('cascade');
            $table->string('path_img_2222336');
            $table->integer('jumlah_2222336');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_2222336');
    }
};
