<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperRole
 */
class Role extends Model
{
    protected $table = 'user_roles';

    protected $fillable = [
        'role',
        'abbreviation',
    ];
}
