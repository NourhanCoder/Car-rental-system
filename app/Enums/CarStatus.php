<?php

namespace App\Enums;

enum CarStatus: string
{
    case AVAILABLE = 'available';
    case RENTED = 'rented';
    case MAINTENANCE = 'maintenance';
}