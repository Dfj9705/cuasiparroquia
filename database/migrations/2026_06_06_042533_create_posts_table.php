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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('post_category_id')
                ->constrained('post_categories')
                ->cascadeOnDelete();

            $table->string('post_title');
            $table->string('post_slug')->unique();
            $table->string('post_summary')->nullable();
            $table->longText('post_content')->nullable();
            $table->string('post_image')->nullable();

            $table->enum('post_status', ['borrador', 'publicado', 'inactivo'])
                ->default('borrador');

            $table->dateTime('post_published_at')->nullable();
            $table->dateTime('post_expires_at')->nullable();

            $table->string('post_meta_title')->nullable();
            $table->text('post_meta_description')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
