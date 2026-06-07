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
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();

            $table->foreignId('download_category_id')
                ->constrained('download_categories')
                ->cascadeOnDelete();

            $table->string('down_title');
            $table->string('down_slug')->unique();
            $table->text('down_description')->nullable();
            $table->string('down_file');
            $table->string('down_file_type')->nullable();
            $table->unsignedBigInteger('down_file_size')->nullable();

            $table->enum('down_status', ['borrador', 'publicado', 'inactivo'])
                ->default('borrador');

            $table->dateTime('down_published_at')->nullable();
            $table->dateTime('down_expires_at')->nullable();

            $table->unsignedInteger('down_downloads_count')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloads');
    }
};
