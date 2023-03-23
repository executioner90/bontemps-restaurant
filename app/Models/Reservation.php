<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Reservation
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $mobile_number
 * @property string $reservation_date
 * @property int $table_id
 * @property int $guest_number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Reservation newModelQuery()
 * @method static Builder|Reservation newQuery()
 * @method static Builder|Reservation query()
 * @method static Builder|Reservation whereCreatedAt($value)
 * @method static Builder|Reservation whereFirstName($value)
 * @method static Builder|Reservation whereGuestNumber($value)
 * @method static Builder|Reservation whereId($value)
 * @method static Builder|Reservation whereLastName($value)
 * @method static Builder|Reservation whereMobileNumber($value)
 * @method static Builder|Reservation whereReservationDate($value)
 * @method static Builder|Reservation whereTableId($value)
 * @method static Builder|Reservation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'mobile_number',
        'reservation_date',
        'table_id',
        'guest_number',
    ];

    public function table(): HasOne
    {
        return $this->HasOne(Table::class);
    }
}
