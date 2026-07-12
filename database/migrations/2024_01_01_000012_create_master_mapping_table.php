<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_mapping', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('location')->nullable();
            $table->string('department')->nullable();
            $table->enum('criticality', ['critical', 'major', 'minor'])->default('major');
            $table->enum('frequency', ['1', '6', '12', '24', '36', '48', '60'])->default('12');
            $table->boolean('is_active')->default(true);
            $table->string('room_dimensions')->nullable();
            $table->integer('standard_points')->nullable();
            $table->decimal('temp_min_spec', 5, 2)->nullable();
            $table->decimal('temp_max_spec', 5, 2)->nullable();
            $table->decimal('rh_min_spec', 5, 2)->nullable();
            $table->decimal('rh_max_spec', 5, 2)->nullable();
            $table->string('vendor')->nullable();
            $table->jsonb('custom_fields')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_mapping');
    }
};
