<?php

declare(strict_types=1);

namespace App\Domains\Academics\Enums;

enum EnrollmentStatus: string
{
    case Active = 'active';
    case Completed = 'completed';
    case Withdrawn = 'withdrawn';
    case Suspended = 'suspended';
}
