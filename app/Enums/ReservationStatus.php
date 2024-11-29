<?php

namespace App\Enums;

enum ReservationStatus: int
{
    case UNCONFIRMED = 1;
    case CONFIRMED = 2;
    case CANCELED = 3;
    case COMPLETED = 4;

    public static function getReservedStatus(): array
    {
        return [
            self::UNCONFIRMED,
            self::CONFIRMED,
        ];
    }

    public static function getAvailableStatus(): array
    {
        return [
            self::CANCELED,
            self::COMPLETED,
        ];
    }
}
