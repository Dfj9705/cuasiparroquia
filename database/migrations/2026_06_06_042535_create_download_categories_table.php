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
        Schema::create('download_categories', function (Blueprint $table) {
            $table->id();

            $table->string('dcat_name');
            $table->string('dcat_slug')->unique();
            $table->text('dcat_description')->nullable();

            $table->enum('dcat_status', ['borrador', 'publicado', 'inactivo'])
                ->default('publicado');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('download_categories');
    }
};
