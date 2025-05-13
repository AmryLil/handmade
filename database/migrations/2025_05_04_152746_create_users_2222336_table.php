<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users_2222336', function (Blueprint $table) {
            $table->string('id_2222336', 20)->primary();
            $table->string('email_2222336')->unique();
            $table->string('name');
            $table->string('password_2222336');
            $table->enum('gender_2222336', ['male', 'female'])->nullable();
            $table->string('role_2222336');
            $table->string('address_2222336')->nullable();
            $table->string('phone_2222336')->nullable();
            $table->date('birth_date_2222336')->nullable();
            $table->string('profile_photo_2222336')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_2222336');
    }
};
