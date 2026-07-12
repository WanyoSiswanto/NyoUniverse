<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MasterMapping extends Model
{
    protected $table = 'master_mapping';

    protected $fillable = [
        'code',
        'name',
        'location',
        'department',
        'criticality',
        'frequency',
        'is_active',
        'room_dimensions',
        'standard_points',
        'temp_min_spec',
        'temp_max_spec',
        'rh_min_spec',
        'rh_max_spec',
        'vendor',
        'custom_fields',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'temp_min_spec' => 'decimal:2',
            'temp_max_spec' => 'decimal:2',
            'rh_min_spec' => 'decimal:2',
            'rh_max_spec' => 'decimal:2',
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
        return $this->hasMany(ProgramMapping::class, 'master_id');
    }

    public function latestProgram(): HasOne
    {
        return $this->hasOne(ProgramMapping::class, 'master_id')->latest('year');
    }
}
