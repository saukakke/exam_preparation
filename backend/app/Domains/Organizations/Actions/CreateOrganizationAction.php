<?php

declare(strict_types=1);

namespace App\Domains\Organizations\Actions;

use App\Domains\Identity\Models\User;
use App\Domains\Organizations\Enums\OrganizationStatus;
use App\Domains\Organizations\Enums\OrganizationType;
use App\Domains\Organizations\Models\Organization;
use Illuminate\Support\Str;

final class CreateOrganizationAction
{
    public function execute(User $owner, string $name, OrganizationType $type, ?string $email = null): Organization
    {
        $organization = Organization::query()->create([
            'name' => $name,
            'slug' => Str::slug($name).'-'.Str::lower(Str::random(6)),
            'type' => $type,
            'status' => OrganizationStatus::Active,
            'email' => $email,
        ]);

        $organization->memberships()->create(['user_id' => $owner->id, 'is_active' => true, 'joined_at' => now()]);
        $owner->assignRole('Organization Owner');

        return $organization;
    }
}
