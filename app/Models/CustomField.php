<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    protected $fillable = [
        'category',
        'key',
        'label',
        'type',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'order' => 'integer',
        ];
    }

    public const CATEGORIES = [
        'calibration',
        'qualification',
        'mapping',
    ];

    public const TYPES = [
        'text',
        'number',
        'date',
        'textarea',
    ];
}
