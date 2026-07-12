<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('execution_qualification', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->unique()->constrained('program_qualification')->onDelete('cascade');
            $table->date('execution_date');
            $table->enum('result', ['pass', 'fail', 'conditional']);
            $table->text('notes')->nullable();
            $table->string('file_link')->nullable();
            $table->string('protocol_number')->nullable();
            $table->date('protocol_approved_date')->nullable();
            $table->date('protocol_valid_until')->nullable();
            $table->date('data_completed_date')->nullable();
            $table->date('report_created_date')->nullable();
            $table->string('report_number')->nullable();
            $table->date('report_approved_date')->nullable();
            $table->date('report_valid_until')->nullable();
            $table->text('capa')->nullable();
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
        Schema::dropIfExists('execution_qualification');
    }
};
