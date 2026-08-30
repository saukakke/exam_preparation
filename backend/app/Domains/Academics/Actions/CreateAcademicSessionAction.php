<?php

declare(strict_types=1);

namespace App\Domains\Academics\Actions;

use App\Domains\Academics\Enums\AcademicSessionStatus;
use App\Domains\Academics\Models\AcademicSession;

final class CreateAcademicSessionAction
{
    public function execute(int $organizationId, string $name, string $startsAt, string $endsAt): AcademicSession
    {
        return AcademicSession::query()->create(['organization_id'=>$organizationId,'name'=>$name,'starts_at'=>$startsAt,'ends_at'=>$endsAt,'status'=>AcademicSessionStatus::Draft]);
    }
}
