<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProgramCalibration extends Model
{
    protected $table = 'program_calibration';

    protected $fillable = [
        'master_id',
        'year',
        'planned_month',
        'planned_date',
        'status',
        'status_override',
        'submitted_by',
        'approved_by',
        'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'planned_date' => 'date',
            'approved_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public const STATUS_OPTIONS = [
        'pending' => 'Pending',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
    ];

    public function master(): BelongsTo
    {
        return $this->belongsTo(MasterCalibration::class, 'master_id');
    }

    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function execution(): HasOne
    {
        return $this->hasOne(ExecutionCalibration::class, 'program_id');
    }
}
