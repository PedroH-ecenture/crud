<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guard_name = 'web'; // importante para Spatie

    protected $table = 'usuarios';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Sobrescrevendo para que Super-admin tenha acesso a tudo
     */
    public function hasPermissionTo($permission, $guardName = null)
    {
        if ($this->hasRole('Super-admin')) {
            return true;
        }

        return $this->getAllPermissions()->contains('name', $permission);
    }

    /**
     * Criptografa a senha automaticamente ao setar
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
