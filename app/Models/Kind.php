<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Meal
 *
 * @property int $id
 * @property string $name
 */

class Kind extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
