<?php

declare(strict_types=1);

namespace App\Domains\Identity\Policies;

use App\Domains\Identity\Models\User;

final class UserPolicy
{
    public function view(User $actor, User $user): bool { return $actor->is($user) || $actor->hasRole('Super Admin'); }
    public function update(User $actor, User $user): bool { return $actor->is($user) || $actor->hasRole('Super Admin'); }
}