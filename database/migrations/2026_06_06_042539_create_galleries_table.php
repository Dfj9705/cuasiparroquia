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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();

            $table->string('gal_title');
            $table->string('gal_slug')->unique();
            $table->text('gal_description')->nullable();

            $table->enum('gal_status', ['borrador', 'publicado', 'inactivo'])
                ->default('borrador');

            $table->dateTime('gal_published_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
