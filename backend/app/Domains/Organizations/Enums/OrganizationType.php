<?php

declare(strict_types=1);

namespace App\Domains\Organizations\Enums;

enum OrganizationType: string
{
    case School = 'school';
    case TrainingCenter = 'training_center';
    case University = 'university';
    case Company = 'company';
    case GovernmentAgency = 'government_agency';
}
