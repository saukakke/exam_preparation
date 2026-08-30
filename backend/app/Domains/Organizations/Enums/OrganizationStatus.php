<?php

declare(strict_types=1);

namespace App\Domains\Organizations\Enums;

enum OrganizationStatus: string
{
    case Active = 'active';
    case Suspended = 'suspended';
    case Pending = 'pending';
    case Archived = 'archived';
}
