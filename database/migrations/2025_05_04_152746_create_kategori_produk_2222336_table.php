<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kategori_produk_2222336', function (Blueprint $table) {
            $table->string('id_2222336', 20)->primary();
            $table->string('nama_2222336');
            $table->text('deskripsi_2222336');
            $table->string('path_img_2222336');
            $table->string('tags_2222336', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_produk_2222336');
    }
};
