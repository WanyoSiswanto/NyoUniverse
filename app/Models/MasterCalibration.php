<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MasterCalibration extends Model
{
    protected $table = 'master_calibration';

    protected $fillable = [
        'code',
        'name',
        'location',
        'department',
        'criticality',
        'frequency',
        'is_active',
        'brand_model',
        'serial_number',
        'measurement_range',
        'tolerance',
        'execution_type',
        'vendor',
        'custom_fields',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'custom_fields' => 'array',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public const CRITICALITY_OPTIONS = [
        'critical' => 'Critical',
        'major' => 'Major',
        'minor' => 'Minor',
    ];

    public const FREQUENCY_OPTIONS = [
        '1' => 'Monthly',
        '6' => '6 Months',
        '12' => 'Yearly',
        '24' => '2 Years',
        '36' => '3 Years',
        '48' => '4 Years',
        '60' => '5 Years',
    ];

    public function programs(): HasMany
    {
        return $this->hasMany(ProgramCalibration::class, 'master_id');
    }

    public function latestProgram(): HasOne
    {
        return $this->hasOne(ProgramCalibration::class, 'master_id')->latest('year');
    }
}
