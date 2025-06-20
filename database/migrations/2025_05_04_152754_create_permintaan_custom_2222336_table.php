<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('permintaan_custom_222336', function (Blueprint $table) {
            $table->string('id_222336', 20)->primary();
            $table->string('user_id_222336', 20);
            $table->foreign('user_id_222336')->references('email_222336')->on('users_222336')->onDelete('cascade');
            $table->string('judul_222336');
            $table->text('deskripsi_222336');
            $table->string('path_img_222336')->nullable();
            $table->enum('status_222336', ['pending', 'diterima', 'ditolak', 'selesai'])->default('pending');
            $table->decimal('harga_penawaran_222336', 10, 2)->nullable();
            $table->decimal('harga_akhir_222336', 10, 2)->nullable();
            $table->text('catatan_admin_222336')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permintaan_custom_222336');
    }
};
