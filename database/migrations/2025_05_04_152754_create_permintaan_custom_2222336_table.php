<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('permintaan_custom_2222336', function (Blueprint $table) {
            $table->string('id_2222336', 20)->primary();
            $table->string('user_id_2222336', 20);
            $table->foreign('user_id_2222336')->references('id_2222336')->on('users_2222336')->onDelete('cascade');
            $table->string('judul_2222336');
            $table->text('deskripsi_2222336');
            $table->string('path_img_2222336')->nullable();
            $table->enum('status_2222336', ['pending', 'diterima', 'ditolak', 'selesai'])->default('pending');
            $table->decimal('harga_penawaran_2222336', 10, 2)->nullable();
            $table->decimal('harga_akhir_2222336', 10, 2)->nullable();
            $table->text('catatan_admin_2222336')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permintaan_custom_2222336');
    }
};
