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
        'firstName', 'lastName', 'email', 'password', 'role_id', 'active', 'activation_token'
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at', 'activation_token'
    ];

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function hasPermission(string $permission): bool
    {
        return $this->roles->permissions->where('slug', $permission)->isNotEmpty();
    }
}
