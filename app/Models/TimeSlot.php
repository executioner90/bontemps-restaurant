<?php

namespace App\Models;

use App\Enums\TableStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Table
 *
 * @property int $id
 * @property int $table_id
 * @property int $from
 * @property int $till
 * @property TableStatus $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Table> $table
 * @property-read Collection<int, Reservation> $reservations
 * @property-read int|null $reservations_count
 * @method static Builder|TimeSlot newModelQuery()
 * @method static Builder|TimeSlot newQuery()
 * @method static Builder|TimeSlot query()
 * @method static Builder|TimeSlot whereCapacity($value)
 * @method static Builder|TimeSlot whereCreatedAt($value)
 * @method static Builder|TimeSlot whereId($value)
 * @method static Builder|TimeSlot whereNumber($value)
 * @method static Builder|TimeSlot whereStatus($value)
 * @method static Builder|TimeSlot whereUpdatedAt($value)
 * @method static Builder|TimeSlot availableSlots()
 * @mixin \Eloquent
 */
class TimeSlot extends Model
{
    use HasFactory;

    protected $table = 'time_slots';

    protected $fillable = [
        'table_id',
        'from',
        'till',
        'status',
    ];

    protected $casts = [
        'status' => TableStatus::class,
    ];

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class, 'reservations_time_slots');
    }

    public function scopeAvailableSlots(Builder $query): Builder
    {
        return $query->where('status', TableStatus::AVAILABLE);
    }
}
