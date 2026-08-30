<?php

declare(strict_types=1);

namespace App\Domains\Academics\Models;

use App\Domains\Organizations\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Course extends Model
{
    protected $fillable = ['organization_id','name','code','description','is_active'];
    protected function casts(): array { return ['is_active'=>'boolean']; }
    public function organization(): BelongsTo { return $this->belongsTo(Organization::class); }
    public function subjects(): BelongsToMany { return $this->belongsToMany(Subject::class); }
}
