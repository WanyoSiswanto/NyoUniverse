<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'department',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function requestedRoles(): BelongsToMany
    {
        return $this->belongsToMany(
            \Spatie\Permission\Models\Role::class,
            'user_requested_roles',
            'user_id',
            'role_id'
        )->withTimestamps();
    }

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return $this->status === 'active';
    }
}
