<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gambar_222336', function (Blueprint $table) {
            $table->string('id_222336', 20)->primary();
            $table->string('produk_id_222336', 20);
            $table->foreign('produk_id_222336')->references('id_222336')->on('produk_222336')->onDelete('cascade');
            $table->string('path_img_222336');
            $table->string('alt_text_222336')->nullable();
            $table->boolean('is_main_222336')->default(false);
            $table->integer('sort_order_222336')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gambar_222336');
    }
};
