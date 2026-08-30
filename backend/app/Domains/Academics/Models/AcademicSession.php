<?php

declare(strict_types=1);

namespace App\Domains\Academics\Models;

use App\Domains\Academics\Enums\AcademicSessionStatus;
use App\Domains\Organizations\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class AcademicSession extends Model
{
    protected $fillable = ['organization_id','name','starts_at','ends_at','status'];
    protected function casts(): array { return ['starts_at'=>'date','ends_at'=>'date','status'=>AcademicSessionStatus::class]; }
    public function organization(): BelongsTo { return $this->belongsTo(Organization::class); }
    public function enrollments(): HasMany { return $this->hasMany(StudentEnrollment::class); }
}
