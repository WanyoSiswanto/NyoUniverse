<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExecutionMapping extends Model
{
    protected $table = 'execution_mapping';

    protected $fillable = [
        'program_id',
        'execution_date',
        'result',
        'notes',
        'file_link',
        'start_date',
        'end_date',
        'points_installed',
        'temp_min',
        'temp_max',
        'rh_min',
        'rh_max',
        'routine_points_recommendation',
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
            'start_date' => 'date',
            'end_date' => 'date',
            'temp_min' => 'decimal:2',
            'temp_max' => 'decimal:2',
            'rh_min' => 'decimal:2',
            'rh_max' => 'decimal:2',
            'points_installed' => 'integer',
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
        return $this->belongsTo(ProgramMapping::class, 'program_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
