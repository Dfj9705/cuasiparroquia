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
        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('gallery_id')
                ->constrained('galleries')
                ->cascadeOnDelete();

            $table->string('gitem_title')->nullable();
            $table->text('gitem_description')->nullable();
            $table->string('gitem_image');
            $table->unsignedInteger('gitem_order')->default(0);

            $table->enum('gitem_status', ['borrador', 'publicado', 'inactivo'])
                ->default('publicado');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_items');
    }
};
