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
        Schema::create('user_biometrics', function (Blueprint $table) {
            $table->id();
            $table->string('face_image_path')->unique();
            $table->string('verification_status')->default('pending')->index();
            $table->timestamps();

            // Foreign Keys
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_biometrics');
    }
};
