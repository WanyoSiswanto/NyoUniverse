<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['calibration', 'qualification', 'mapping']);
            $table->string('key');
            $table->string('label');
            $table->enum('type', ['text', 'number', 'date', 'textarea'])->default('text');
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->unique(['category', 'key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_fields');
    }
};
