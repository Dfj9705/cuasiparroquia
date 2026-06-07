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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();

            $table->string('ann_title');
            $table->string('ann_slug')->unique();
            $table->text('ann_description')->nullable();
            $table->string('ann_image')->nullable();

            $table->enum('ann_status', ['borrador', 'publicado', 'inactivo'])
                ->default('borrador');

            $table->dateTime('ann_published_at')->nullable();
            $table->dateTime('ann_expires_at')->nullable();

            $table->unsignedInteger('ann_priority')->default(0);

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
        Schema::dropIfExists('announcements');
    }
};
