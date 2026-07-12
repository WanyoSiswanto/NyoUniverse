<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_qualification', function (Blueprint $table) {
            $table->id();
            $table->foreignId('master_id')->constrained('master_qualification')->onDelete('cascade');
            $table->integer('year');
            $table->tinyInteger('planned_month');
            $table->date('planned_date')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('status_override')->nullable();
            $table->foreignId('submitted_by')->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->unique(['master_id', 'year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_qualification');
    }
};
