<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('execution_mapping', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->unique()->constrained('program_mapping')->onDelete('cascade');
            $table->date('execution_date');
            $table->enum('result', ['pass', 'fail', 'conditional']);
            $table->text('notes')->nullable();
            $table->string('file_link')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('points_installed')->nullable();
            $table->decimal('temp_min', 5, 2)->nullable();
            $table->decimal('temp_max', 5, 2)->nullable();
            $table->decimal('rh_min', 5, 2)->nullable();
            $table->decimal('rh_max', 5, 2)->nullable();
            $table->text('routine_points_recommendation')->nullable();
            $table->jsonb('custom_fields')->nullable();
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamp('approved_at')->nullable();
            $table->text('approval_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('execution_mapping');
    }
};
