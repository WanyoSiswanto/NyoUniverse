<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('execution_calibration', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->unique()->constrained('program_calibration')->onDelete('cascade');
            $table->date('execution_date');
            $table->enum('result', ['pass', 'fail', 'conditional']);
            $table->text('notes')->nullable();
            $table->string('file_link')->nullable();
            $table->string('value_as_found')->nullable();
            $table->string('value_as_left')->nullable();
            $table->string('certificate_number')->nullable();
            $table->string('technician')->nullable();
            $table->date('vendor_recalibration_date')->nullable();
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
        Schema::dropIfExists('execution_calibration');
    }
};
