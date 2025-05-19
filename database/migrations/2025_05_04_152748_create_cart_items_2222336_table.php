<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cart_items_222336', function (Blueprint $table) {
            $table->string('id_222336', 20)->primary();
            $table->string('cart_id_222336', 20);
            $table->foreign('cart_id_222336')->references('id_222336')->on('carts_222336')->onDelete('cascade');
            $table->string('product_id_222336', 20);
            $table->foreign('product_id_222336')->references('id_222336')->on('produk_222336')->onDelete('cascade');
            $table->integer('quantity_222336');
            $table->decimal('price_222336', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items_222336');
    }
};
