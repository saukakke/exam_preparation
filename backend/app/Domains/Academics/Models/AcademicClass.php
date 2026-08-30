<?php

declare(strict_types=1);

namespace App\Domains\Academics\Models;

use App\Domains\Organizations\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class AcademicClass extends Model
{
    protected $table = 'academic_classes';
    protected $fillable = ['organization_id','name','code','level','is_active'];
    protected function casts(): array { return ['is_active'=>'boolean']; }
    public function organization(): BelongsTo { return $this->belongsTo(Organization::class); }
}
