<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Meal
 *
 * @property int $id
 * @property string $name
 * @property HasMany|null $meals
 */

class Kind extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function meals(): HasMany
    {
        return $this->hasMany(Meal::class);
    }
}
