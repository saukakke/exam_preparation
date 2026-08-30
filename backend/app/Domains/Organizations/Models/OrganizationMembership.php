<?php

declare(strict_types=1);

namespace App\Domains\Organizations\Models;

use App\Domains\Identity\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class OrganizationMembership extends Model
{
    protected $fillable = ['organization_id', 'user_id', 'branch_id', 'department_id', 'is_active', 'joined_at'];
    protected function casts(): array { return ['is_active' => 'boolean', 'joined_at' => 'datetime']; }
    public function organization(): BelongsTo { return $this->belongsTo(Organization::class); }
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function branch(): BelongsTo { return $this->belongsTo(Branch::class); }
    public function department(): BelongsTo { return $this->belongsTo(Department::class); }
}
