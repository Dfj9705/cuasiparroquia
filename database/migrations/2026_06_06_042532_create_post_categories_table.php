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
        Schema::create('post_categories', function (Blueprint $table) {
            $table->id();

            $table->string('pcat_name');
            $table->string('pcat_slug')->unique();
            $table->text('pcat_description')->nullable();

            $table->enum('pcat_status', ['borrador', 'publicado', 'inactivo'])
                ->default('publicado');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_categories');
    }
};
