<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users_222336', function (Blueprint $table) {
            $table->string('id_222336', 20)->primary();
            $table->string('email_222336')->unique();
            $table->string('name');
            $table->string('password_222336');
            $table->string('role_222336');
            $table->string('profile_photo_222336')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_222336');
    }
};
