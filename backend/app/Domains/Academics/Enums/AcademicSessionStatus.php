<?php

declare(strict_types=1);

namespace App\Domains\Academics\Enums;

enum AcademicSessionStatus: string
{
    case Draft = 'draft';
    case Active = 'active';
    case Closed = 'closed';
}
