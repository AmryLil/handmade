<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('preview_2222336', function (Blueprint $table) {
            $table->string('id_2222336', 20)->primary();
            $table->string('produk_id_2222336', 20);
            $table->foreign('produk_id_2222336')->references('id_2222336')->on('produk_2222336')->onDelete('cascade');
            $table->string('user_id_2222336', 20);
            $table->foreign('user_id_2222336')->references('id_2222336')->on('users_2222336')->onDelete('cascade');
            $table->text('komentar_2222336');
            $table->integer('rating_2222336')->default(0);
            $table->boolean('is_approved_2222336')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('preview_2222336');
    }
};
