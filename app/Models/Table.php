<?php

namespace App\Models;

use App\Enums\TableStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * App\Models\Table
 *
 * @property int $id
 * @property string $name
 * @property int $guest_number
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|null $reservations
 * @method static Builder|Table newModelQuery()
 * @method static Builder|Table newQuery()
 * @method static Builder|Table query()
 * @method static Builder|Table whereCreatedAt($value)
 * @method static Builder|Table whereGuestNumber($value)
 * @method static Builder|Table whereId($value)
 * @method static Builder|Table whereName($value)
 * @method static Builder|Table whereStatus($value)
 * @method static Builder|Table whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'guest_number',
        'status',
    ];

    protected $casts = [
        'status' => TableStatus::class,
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
