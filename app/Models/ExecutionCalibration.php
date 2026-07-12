<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExecutionCalibration extends Model
{
    protected $table = 'execution_calibration';

    protected $fillable = [
        'program_id',
        'execution_date',
        'result',
        'notes',
        'file_link',
        'value_as_found',
        'value_as_left',
        'certificate_number',
        'technician',
        'vendor_recalibration_date',
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
            'vendor_recalibration_date' => 'date',
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
        return $this->belongsTo(ProgramCalibration::class, 'program_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
