<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cart_items_2222336', function (Blueprint $table) {
            $table->string('id_2222336', 20)->primary();
            $table->string('cart_id_2222336', 20);
            $table->foreign('cart_id_2222336')->references('id_2222336')->on('carts_2222336')->onDelete('cascade');
            $table->string('product_id_2222336', 20);
            $table->foreign('product_id_2222336')->references('id_2222336')->on('produk_2222336')->onDelete('cascade');
            $table->integer('quantity_2222336');
            $table->decimal('price_2222336', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items_2222336');
    }
};
