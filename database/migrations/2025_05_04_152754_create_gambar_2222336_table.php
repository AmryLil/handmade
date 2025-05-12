<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gambar_2222336', function (Blueprint $table) {
            $table->string('id_2222336', 20)->primary();
            $table->string('produk_id_2222336', 20);
            $table->foreign('produk_id_2222336')->references('id_2222336')->on('produk_2222336')->onDelete('cascade');
            $table->string('path_img_2222336');
            $table->string('alt_text_2222336')->nullable();
            $table->boolean('is_main_2222336')->default(false);
            $table->integer('sort_order_2222336')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gambar_2222336');
    }
};
