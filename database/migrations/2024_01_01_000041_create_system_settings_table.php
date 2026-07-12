<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('timezone')->default('Asia/Jakarta');
            $table->string('date_format')->default('d/m/Y');
            $table->string('number_format')->default('id');
            $table->enum('language', ['en', 'id'])->default('id');
            $table->integer('active_year')->default(now()->year);
            $table->jsonb('export_defaults')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
