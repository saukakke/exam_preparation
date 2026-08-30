<?php

declare(strict_types=1);

namespace App\Domains\Organizations\Models;

use App\Domains\Organizations\Enums\OrganizationStatus;
use App\Domains\Organizations\Enums\OrganizationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Organization extends Model
{
    protected $fillable = ['name', 'slug', 'type', 'status', 'email', 'phone', 'website', 'settings'];

    protected function casts(): array
    {
        return ['type' => OrganizationType::class, 'status' => OrganizationStatus::class, 'settings' => 'array'];
    }

    public function branches(): HasMany { return $this->hasMany(Branch::class); }
    public function departments(): HasMany { return $this->hasMany(Department::class); }
    public function memberships(): HasMany { return $this->hasMany(OrganizationMembership::class); }
}
