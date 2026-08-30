<?php

declare(strict_types=1);

namespace App\Domains\Organizations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Branch extends Model
{
    protected $fillable = ['organization_id', 'name', 'code', 'address', 'is_active'];
    protected function casts(): array { return ['is_active' => 'boolean']; }
    public function organization(): BelongsTo { return $this->belongsTo(Organization::class); }
}
