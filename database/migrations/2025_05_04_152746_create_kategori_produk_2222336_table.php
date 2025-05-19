<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kategori_produk_222336', function (Blueprint $table) {
            $table->string('id_222336', 20)->primary();
            $table->string('nama_222336');
            $table->text('deskripsi_222336');
            $table->string('path_img_222336');
            $table->string('tags_222336', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_produk_222336');
    }
};
