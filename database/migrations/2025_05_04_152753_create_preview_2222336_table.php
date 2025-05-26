<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('preview_222336', function (Blueprint $table) {
            $table->string('id_222336', 20)->primary();
            $table->string('produk_id_222336', 20);
            $table->foreign('produk_id_222336')->references('id_222336')->on('produk_222336')->onDelete('cascade');
            $table->string('user_id_222336', 20);
            $table->foreign('user_id_222336')->references('email_222336')->on('users_222336')->onDelete('cascade');
            $table->text('komentar_222336');
            $table->integer('rating_222336')->default(0);
            $table->boolean('is_approved_222336')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('preview_222336');
    }
};
