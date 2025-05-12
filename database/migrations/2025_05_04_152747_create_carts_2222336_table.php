<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('carts_2222336', function (Blueprint $table) {
            $table->string('id_2222336', 20)->primary();
            $table->string('user_id_2222336', 20);
            $table->foreign('user_id_2222336')->references('id_2222336')->on('users_2222336')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts_2222336');
    }
};
