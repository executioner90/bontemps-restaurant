<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperTable
 */
class Table extends Model
{
    use HasFactory;

    protected $table = 'tables';

    protected $fillable = [
        'number',
        'capacity',
    ];

    public function timeSlots(): HasMany
    {
        return $this->hasMany(TimeSlot::class);
    }
}
