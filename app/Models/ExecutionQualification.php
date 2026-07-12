<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExecutionQualification extends Model
{
    protected $table = 'execution_qualification';

    protected $fillable = [
        'program_id',
        'execution_date',
        'result',
        'notes',
        'file_link',
        'protocol_number',
        'protocol_approved_date',
        'protocol_valid_until',
        'data_completed_date',
        'report_created_date',
        'report_number',
        'report_approved_date',
        'report_valid_until',
        'capa',
        'custom_fields',
        'approval_status',
        'approved_by',
        'approved_at',
        'approval_notes',
    ];

    protected function casts(): array
    {
        return [
            'execution_date' => 'date',
            'protocol_approved_date' => 'date',
            'protocol_valid_until' => 'date',
            'data_completed_date' => 'date',
            'report_created_date' => 'date',
            'report_approved_date' => 'date',
            'report_valid_until' => 'date',
            'approved_at' => 'datetime',
            'custom_fields' => 'array',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public const RESULT_OPTIONS = [
        'pass' => 'Pass',
        'fail' => 'Fail',
        'conditional' => 'Conditional',
    ];

    public const APPROVAL_STATUS_OPTIONS = [
        'pending' => 'Pending',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(ProgramQualification::class, 'program_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
