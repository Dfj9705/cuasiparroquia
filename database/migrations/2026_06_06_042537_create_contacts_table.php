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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();

            $table->string('con_name');
            $table->string('con_email')->nullable();
            $table->string('con_phone')->nullable();
            $table->string('con_subject')->nullable();
            $table->text('con_message');

            $table->enum('con_status', ['pendiente', 'leido', 'respondido', 'archivado'])
                ->default('pendiente');

            $table->string('con_ip')->nullable();
            $table->text('con_user_agent')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
