<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domains\Identity\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->count(10)->create();
    }
}
