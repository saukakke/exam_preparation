<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domains\Identity\Enums\RoleName;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

final class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'users.view', 'users.create', 'users.update', 'users.delete',
            'organizations.view', 'organizations.manage',
            'questions.view', 'questions.create', 'questions.update', 'questions.review', 'questions.approve',
            'exams.view', 'exams.create', 'exams.manage', 'exams.monitor',
            'results.view', 'results.grade', 'reports.export',
            'billing.view', 'billing.manage', 'system.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        $all = Permission::query()->get();
        foreach (RoleName::cases() as $roleName) {
            $role = Role::findOrCreate($roleName->value, 'web');
            if ($roleName === RoleName::SuperAdmin) {
                $role->syncPermissions($all);
            }
        }

        Role::findByName(RoleName::Student->value, 'web')->syncPermissions([
            Permission::findByName('questions.view', 'web'),
            Permission::findByName('exams.view', 'web'),
            Permission::findByName('results.view', 'web'),
        ]);
    }
}
