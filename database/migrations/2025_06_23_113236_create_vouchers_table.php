<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vouchers_222336', function (Blueprint $table) {
            $table->string('id_voucher_222336')->primary();
            $table->string('kode_voucher_222336')->unique();
            $table->string('id_user_222336');
            $table->foreign('id_user_222336')->references('email_222336')->on('users_222336')->onDelete('cascade');
            $table->enum('tipe_222336', ['loyalitas', 'pengguna_baru'])->default('loyalitas');
            $table->decimal('persentase_diskon_222336', 5, 2);
            $table->date('tanggal_kadaluarsa_222336');
            $table->enum('status_222336', ['tersedia', 'terpakai'])->default('tersedia');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vouchers_222336');
    }
};
