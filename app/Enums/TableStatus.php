<?php

namespace App\Enums;

enum TableStatus: int
{
    case AVAILABLE = 1;
    case RESERVED = 2;
    case UNAVAILABLE = 3;
}
