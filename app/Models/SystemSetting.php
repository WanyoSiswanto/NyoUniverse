<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $table = 'system_settings';

    protected $fillable = [
        'timezone',
        'date_format',
        'number_format',
        'language',
        'active_year',
        'export_defaults',
    ];

    protected function casts(): array
    {
        return [
            'export_defaults' => 'array',
        ];
    }

    public static function getSettings(): ?self
    {
        return self::first();
    }
}
