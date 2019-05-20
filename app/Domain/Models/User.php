<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    protected $fillable = [
        'cpf', 'firstName', 'lastName', 'email', 'password', 'role_id', 'active', 'code'
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'password', 'created_at', 'updated_at', 'code'
    ];

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function hasPermission(string $permission): bool
    {
        return $this->roles->permissions->where('slug', $permission)->isNotEmpty();
    }

    public function isActive(): bool
    {
        return $this->active == 1 ? true : false;
    }
}
