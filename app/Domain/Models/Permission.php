<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $hidden = [
      'pivot', 'created_at', "updated_at"
    ];
}
