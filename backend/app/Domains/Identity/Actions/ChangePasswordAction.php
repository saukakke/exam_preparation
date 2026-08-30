<?php

declare(strict_types=1);

namespace App\Domains\Identity\Actions;

use App\Domains\Identity\Models\User;

final class ChangePasswordAction
{
    public function execute(User $user, string $password): void
    {
        $user->forceFill(['password' => $password])->save();
        $user->tokens()->delete();
    }
}
