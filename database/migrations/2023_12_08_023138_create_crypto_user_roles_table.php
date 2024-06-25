<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('crypto_user_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crypto_user_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

            // Definir las claves foráneas
            $table->foreign('crypto_user_id')->references('id')->on('crypto_users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto_user_roles');
    }
};
