<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();

            $table->string('site_name');
            $table->string('site_slogan')->nullable();

            $table->string('site_email')->nullable();
            $table->string('site_phone')->nullable();
            $table->string('site_whatsapp')->nullable();

            $table->text('site_address')->nullable();

            $table->string('site_logo')->nullable();
            $table->string('site_favicon')->nullable();

            $table->string('site_facebook')->nullable();
            $table->string('site_instagram')->nullable();
            $table->string('site_youtube')->nullable();

            $table->string('site_meta_title')->nullable();
            $table->text('site_meta_description')->nullable();

            $table->enum('site_status', [
                'activo',
                'mantenimiento',
            ])->default('activo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
